<?php

namespace App\Listeners;

use App\Events\VehicleUpdating as VehicleUpdatingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleUpdating
{
    /**
     * Handle the event.
     *
     * @param  VehicleUpdatingEvent  $event
     * @return void
     */
    public function handle(VehicleUpdatingEvent $event)
    {
        $vehicle = $event->vehicle;
        $vehicle->slug = str_slug($vehicle->name().' '.$vehicle->name);
    }
}
