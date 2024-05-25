<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Game;
use App\Models\Player;
use App\Notifications\MatchEvent;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    protected $appends = ['created_date'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # returns 20 notifications of the logged in user together with the
        # time it was created, in a human readable way
        return auth()->user()->notifications->map(function($n) {
            $n->sent_date = $n->created_at->diffForHumans();
            $n->unread_count = $n->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count();

            return ($n);
        })->take(20);
    }

    /**
     * Mark a notification as read
     *
     * @param $notificationId
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($notificationId)
    {
        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->markAsRead();

        # returns 10 notifications of the logged in user together with the
        # time it was created, in a human readable way
        return auth()->user()->notifications->map(function($n) {
            $n->sent_date = $n->created_at->diffForHumans();
            $n->unread_count = $n->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count();

            return ($n);
        })->take(10);

    }

    /**
     * @return mixed
     */
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        # returns 10 notifications of the logged in user together with the
        # time it was created, in a human readable way
        return auth()->user()->notifications->map(function($n) {
            $n->sent_date = $n->created_at->diffForHumans();
            $n->unread_count = $n->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count();

            return ($n);
        })->take(10);
    }

    /**
     * @param $notificationId
     * @return mixed
     */
    public function delete($notificationId)
    {
        $notification = DatabaseNotification::findOrFail($notificationId);
        $notification->delete();

        # returns 10 notifications of the logged in user together with the
        # time it was created, in a human readable way
        return auth()->user()->notifications->map(function($n) {
            $n->sent_date = $n->created_at->diffForHumans();
            $n->unread_count = $n->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count();

            return ($n);
        })->take(10);
    }

    /**
     * @return mixed
     */
    public function deleteAll()
    {
        auth()->user()->notifications()->delete();

        # returns 10 notifications of the logged in user together with the
        # time it was created, in a human readable way
        return auth()->user()->notifications->map(function($n) {
            $n->sent_date = $n->created_at->diffForHumans();
            $n->unread_count = $n->where('notifiable_id', auth()->user()->id)->whereNull('read_at')->count();

            return ($n);
        })->take(10);
    }

    public function saveMatchEvent(Request $request)
    {
        $game = Game::with('homeTeam', 'awayTeam')->find($request->input('game_id'));
        $minute = $request->input('minute');
        $player_id = $request->input('player_id');
        $type = $request->input('type');
        // set player first
        $player = Player::where('player_id', $player_id)->first();
        $player_country = Country::where('api_country_code', $player->country_id)->first()->name;
        // bundle all data in a single array
        $notificationData = [
            'game' => $game,
            'minute' => $minute,
            'player' => $player,
            'player_id' => $player_id,
            'player_country' => $player_country,
            'player_name' => $player->name,
            'event_type' => $type
        ];
        // send all followers of this game an notification
        $followers = $game->users()->get();

        foreach($followers as $user) {
            $user->notify(new MatchEvent($notificationData));
        }

        // send success back
        return response()->json(['message' => 'done!']);

    }
}
