<?php

namespace App\Listeners;

use App\Events\VehicleCreating as VehicleCreatingEvent;
use App\Vehicle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleCreating
{
    /**
     * Handle the event.
     *
     * @param  VehicleCreatingEvent  $event
     * @return void
     */
    public function handle(VehicleCreatingEvent $event)
    {
        $vehicle = $event->vehicle;
        $vehicle->name = Vehicle::createUniqueId();
        $vehicle->slug = str_slug($vehicle->name().' '.$vehicle->name);
    }
}
