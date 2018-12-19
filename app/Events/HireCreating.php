<?php

namespace App\Events;

use App\Hire;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HireCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hire;

    /**
     * Create a new event instance.
     *
     * @param Hire $hire
     */
    public function __construct(Hire $hire)
    {
        $this->hire = $hire;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
