<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $old_message;
    public $chat_id;
    public $sender_id;
    public $reciver_id;
    public $new_message;
    public $sender;
    public $reciver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($old_message, $chat_id, $sender_id, $reciver_id, $new_message, $sender, $reciver)
    {
        $this->old_message = $old_message;
        $this->chat_id = $chat_id;
        $this->sender_id = $sender_id;
        $this->reciver_id = $reciver_id;
        $this->new_message = $new_message;
        $this->sender = $sender;
        $this->reciver = $reciver;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['sent_message'];
    }

    public function broadcastAs()
    {
        return 'SendMessage';
    }
}
