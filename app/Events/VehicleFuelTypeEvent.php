<?php

namespace App\Events;

use App\VehicleFuelType;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VehicleFuelTypeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vehicleFuelType;

    /**
     * Create a new event instance.
     *
     * @param VehicleFuelType $vehicleFuelType
     */
    public function __construct(VehicleFuelType $vehicleFuelType)
    {
        $this->vehicleFuelType = $vehicleFuelType;
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
