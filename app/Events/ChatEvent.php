<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Console\Scheduling\Event;

class ChatEvent extends Event implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $chat;
    private $room_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($chat, $room_id)
    {
        $this->room_id = $room_id;
        $this->chat = htmlspecialchars($chat ,ENT_QUOTES ,'UTF-8');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [$this->room_id];
    }
}
