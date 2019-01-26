<?php

namespace App\Events;

use App\VehicleType;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VehicleTypeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vehicleType;

    /**
     * Create a new event instance.
     *
     * @param VehicleType $vehicleType
     */
    public function __construct(VehicleType $vehicleType)
    {
        $this->vehicleType = $vehicleType;
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
