<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Console\Scheduling\Event;

class PusherEvent extends Event implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $location;
    private $channel_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($location,$channel_id)
    {
        $this->channel_id = $channel_id;
        $this->location = $location;

        dd($channel_id);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [$this->channel_id];
    }
}
