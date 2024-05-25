<?php

use App\Jobs\SendMatchEventNotification;
use App\Models\Country;
use App\Models\Game;
use App\Models\NotifiedEvent;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Notifications\MatchEvent;
use Illuminate\Support\Facades\RateLimiter;
use App\Events\NewNotification;

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$matchId = $argv[1] ?? null;

if (!$matchId) {
    echo "Please provide a matchId as an argument.\n";
    exit(1);
}

// Define the polling interval in seconds
$pollingInterval = 60; // 60 seconds (1 minute)

while (true) {
    echo "Polling match events for match ID: $matchId\n";
    echo "-------------------------------------------\n";

    // Poll the external API
    $response = Http::withHeaders([
        "x-rapidapi-host" => 'v3.football.api-sports.io',//env('MIX_API_URL'),
        "x-rapidapi-key" => '6d32cb8b8dfb35683029e61b40dab0aa'//env('MIX_API_KEY')
    ])->withoutVerifying()->get("https://v3.football.api-sports.io/fixtures", [
        'id' => $matchId
    ]);

    if ($response->successful()) {
        echo "received response from api\n";
        $data = $response->json();

        // get the Game Model
        $game = Game::with('homeTeam', 'awayTeam')->where('api_id', $data['response'][0]['fixture']['id'])->first();

        // initialize some data we'll need later on
        $events =           $data['response'][0]['events'];
        $hometeamId =       $data['response'][0]['teams']['home']['id'];
        $awayteamId =       $data['response'][0]['teams']['away']['id'];
        $hometeamScore =    0;
        $awayteamScore =    0;
        $latestGoal =       '';
        $teamscoredName =   '';
        $followers =        $game->users()->get();
        $followersCount =   $followers->count();
        $notificationsAreSent = false;

        // game details
        echo "Game: " . $data['response'][0]['teams']['home']['name'] . " - " . $data['response'][0]['teams']['away']['name'] . "\n";
        // how many followers are here
        echo "This game has " . $followersCount . " follower(s)\n";
        echo "-------------------------------------------\n";

        // Iterate over the match events
        foreach ($events as $event) {
            // Generate unique key for this event
            $uniqueKey = md5(json_encode([
                'time'      => $event['time']['elapsed'],
                'team_id'   => $event['team']['id'],
                'player_id' => $event['player']['id'],
                'type'      => $event['type'],
                'detail'    => $event['detail']
            ]));

            $eventType = $event['type'];

            // change the event types so our notification can deal with it
            switch($event['type']) {
                case 'Card':
                    if($event['detail'] === 'Yellow Card') {
                        $event_type = 'yellowCard';
                    }   elseif($event['detail'] === 'Red Card') {
                        $event_type = 'redCard';
                    }
                    break;
                case 'Goal':
                    if($event['detail'] === 'Normal Goal') {
                        $event_type = 'normalGoal';
                        // is the goal scored by home team or away team?
                        // set scoreline accordingly
                        if ($event['team']['id'] === $hometeamId) {
                            $hometeamScore++;
                            $latestGoal = 'home';
                            $teamscoredName = $event['team']['name'];
                        }   else {
                            $awayteamScore++;
                            $latestGoal = 'away';
                            $teamscoredName = $event['team']['name'];
                        }
                    }   elseif($event['detail'] === 'Own Goal') {
                            $event_type = 'ownGoal';
                            // is the goal scored by home team or away team?
                            // set scoreline accordingly
                            if ($event['team']['id'] === $hometeamId) {
                                $hometeamScore++;
                                $latestGoal = 'home';
                                $teamscoredName = $event['team']['name'];
                            }   else {
                                $awayteamScore++;
                                $latestGoal = 'away';
                                $teamscoredName = $event['team']['name'];
                            }
                    }   elseif($event['detail'] === 'Penalty') {
                            $event_type = 'Penalty';
                            // is the goal scored by home team or away team?
                            // set scoreline accordingly
                            if ($event['team']['id'] === $hometeamId) {
                                $hometeamScore++;
                                $latestGoal = 'home';
                                $teamscoredName = $event['team']['name'];
                            }   else {
                                $awayteamScore++;
                                $latestGoal = 'away';
                                $teamscoredName = $event['team']['name'];
                            }
                    }   elseif($event['detail'] === 'Missed Penalty') {
                        $event_type = 'missedPenalty';
                        // is the goal scored by home team or away team?
                        // set scoreline accordingly
                        if ($event['team']['id'] === $hometeamId) {
                            $teamscoredName = $event['team']['name'];
                        }   else {
                            $teamscoredName = $event['team']['name'];
                        }
                    }
                    break;
                default:
                    $event_type = 'other';
            }

            /*
             * Sometimes it happens, very rarely, that a player in the event is not listed
             * in the database. In that case we'll use the name the api gives us which is
             * lacking a first name
             *
             */
            $player = Player::where('player_id', $event['player']['id'])->first();

            if ($player) {
                $player_country = $event['team']['name'];
            } else {
                $player_country = $event['team']['name'];
                $nonDB_playerName = $event['player']['name'];
            }

            $player_name = $player ? $player->name : $nonDB_playerName;

            // array to send to notification handler
            $notificationData = [
                'game'              => $game,
                'minute'            => $event['time']['elapsed'],
                'player_id'         => $event['player']['id'],
                'player_country'    => $player_country,
                'player_name'       => $player_name,
                'event_type'        => $event_type,
                'homeTeamScore'     => $hometeamScore,
                'awayTeamScore'     => $awayteamScore,
                'latestGoal'        => $latestGoal,
                'teamScoredName'    => $teamscoredName
            ];

            // only send out notifications if the events are either a 'goal' or a 'card'
            if($event['type'] !== 'Goal' && $event['type'] !== 'Card') {
                echo "Event is not eligible for notification: it is of type '{$event['type']}'\n";
                continue;
            }   else {
            // send notifications to all followers of this game

                foreach ($followers as $user) {
                    // message for the private event
                    $message = "New events for game $matchId";

                    // skip notification if the notification has been sent before
                    $notifiedEvent = NotifiedEvent::where('unique_key', $uniqueKey)
                        ->where('user_id', $user->id)
                        ->first();

                    if($notifiedEvent) {
                        continue;
                    }

                    // Check rate limit for the user
                    $rateLimiterKey = "send-notification:{$user->id}";
                    if (RateLimiter::tooManyAttempts($rateLimiterKey, 30)) {
                        continue;
                    }

                    // Increment the rate limit counter
                    RateLimiter::hit($rateLimiterKey, 60);

                    // send notification
                    $user->notify(new MatchEvent($notificationData));
                    echo $notificationData['event_type'] . " notification sent to " . $user->name . "\n";
                    // remember that notifications have been sent
                    $notificationsAreSent = true;

                    // store notification record
                    NotifiedEvent::create([
                        'unique_key' => $uniqueKey,
                        'user_id' => $user->id
                    ]);


                }

            }
            // add a small delay so notifications aren't sent in the same second
            sleep(1);
        }
        // if notifications have been sent, let user know to check DB
        if($notificationsAreSent) {
            foreach($followers as $user) {
                // fire event so vue component will check for notification
                event(new NewNotification($user->id, $message));
            }
        }
    } else {
        echo "Failed to fetch match events\n";
    }

    // Sleep for the polling interval
    echo "Going to sleep for " . $pollingInterval . " seconds. After I will check for more events.";
    sleep($pollingInterval);
}
