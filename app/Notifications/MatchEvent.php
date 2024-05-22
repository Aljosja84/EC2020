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

    public array $notificationData;

    /**
     * MatchEvent constructor.
     * @param $notificationData
     */
    public function __construct($notificationData)
    {
        $this->notificationData = $notificationData;
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
        // this array will be stored in DB
        return [
            'game' => $this->notificationData['game'],
            'event_type' => $this->notificationData['event_type'],
            'player_name' => $this->notificationData['player_name'],
            'player_country' => $this->notificationData['player_country'],
            'minute' => $this->notificationData['minute'],
        ];
    }
}
