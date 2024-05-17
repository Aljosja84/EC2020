<?php

use App\Models\Game;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Notifications\MatchEvent;

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

    // Poll the external API
    $response = Http::withHeaders([
        "x-rapidapi-host" => env('MIX_API_URL'),
        "x-rapidapi-key" => env('MIX_API_KEY')
    ])->get("https://v3.football.api-sports.io/fixtures", [
        'id' => $matchId
    ]);

    if ($response->successful()) {
        $data = $response->json();

        foreach ($data as $match) {
            $events = $match['events'] ?? [];

            foreach ($events as $event) {
                $notificationData = [
                    'minute' => $event['time']['elapsed'],
                    'gameId' => $match['fixture']['id'],
                    'playerId' => $event['player']['id'],
                    'eventType' => $event['type'],
                    'detail' => $event['detail'],
                    'team' => $event['team']['name'],
                    'player' => $event['player']['name'],
                    'comments' => $event['comments'],
                ];

                $game = Game::with('homeTeam', 'awayTeam')->where('api_id', $notificationData['gameId'])->first();
                $minute = $notificationData['minute'];
                $player_id = $notificationData['playerId'];
                $event_type = $notificationData['eventType'];

                // send all followers of this game an notification
                $followers = $game->users()->get();

                foreach($followers as $user) {
                    $user->notify(new MatchEvent($game, $minute, $player_id, $event_type));
                }
            }
        }
    } else {
        echo "Failed to fetch match events\n";
    }

    // Sleep for the polling interval
    sleep($pollingInterval);
}
