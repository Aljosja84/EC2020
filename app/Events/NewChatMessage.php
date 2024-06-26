<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Avatar;

class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatMessage;
    public $user;
    public $avatar;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param ChatMessage $chatMessage
     */
    public function __construct(User $user, ChatMessage $chatMessage)
    {
        $this->user = $user;
        $this->avatar = $user->avatar;
        $this->chatMessage = $chatMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('presence-chatroom.' . $this->chatMessage->chat_room_id);
    }

    public function broadcastAs()
    {
        return 'message.new';
    }
}
