<?php

namespace App\Notifications;

use App\Models\Country;
use App\Models\Game;
use App\Models\Player;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MatchEvent extends Notification
{
    use Queueable;

    public $game;
    public $event_type;
    public $player_id;
    public $minute;

    /**
     * Create a new notification instance.
     *
     * @param Game $game
     * @param $event_type
     * @param $player_id
     * @param $minute
     */
    public function __construct($game, $minute, $player_id, $event_type)
    {
        $this->game = $game;
        $this->event_type = $event_type;
        $this->player_id = $player_id;
        $this->minute = $minute;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // set player first
        $player = Player::where('player_id', $this->player_id)->first();
        $player_country = Country::where('api_country_code', $player->country_id)->first()->name;
        // this array will be stored in DB
        return [
            'game' => $this->game,
            'event_type' => $this->event_type,
            'player_name' => $player->name,
            'player_country' => $player_country,
            'minute' => $this->minute,
        ];
    }
}
