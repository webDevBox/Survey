<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserProfile implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $old_message;
    public $sender_id;
    public $reciver_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($old_message, $sender_id, $reciver_id)
    {
        $this->old_message = $old_message;
        $this->sender_id = $sender_id;
        $this->reciver_id = $reciver_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['view-profile'];
    }

    public function broadcastAs()
    {
        return 'UserProfile';
    }
}
