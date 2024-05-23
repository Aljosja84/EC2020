<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\MatchEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMatchEventNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $event;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $event)
    {
        $this->userId = $userId;
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->userId);
        if($user) {
            $user->notify(new MatchEvent($this->event));
        }
    }
}
