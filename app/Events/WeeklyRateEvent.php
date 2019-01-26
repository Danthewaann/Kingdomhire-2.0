<?php

namespace App\Events;

use App\WeeklyRate;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WeeklyRateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $weeklyRate;

    /**
     * Create a new event instance.
     *
     * @param WeeklyRate $weeklyRate
     */
    public function __construct(WeeklyRate $weeklyRate)
    {
        $this->weeklyRate = $weeklyRate;
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
