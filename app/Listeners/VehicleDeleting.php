<?php

namespace App\Listeners;

use App\Events\VehicleDeleting as VehicleDeletingEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleDeleting
{
    /**
     * Handle the event.
     *
     * @param  VehicleDeletingEvent  $event
     * @return void
     */
    public function handle(VehicleDeletingEvent $event)
    {
        $vehicle = $event->vehicle;
        $vehicle->deleteImages();
    }
}
