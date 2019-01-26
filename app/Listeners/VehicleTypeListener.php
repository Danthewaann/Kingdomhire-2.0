<?php

namespace App\Listeners;

use App\Events\VehicleTypeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleTypeListener
{
    /**
     * Handle the event.
     *
     * @param  VehicleTypeEvent  $event
     * @return void
     */
    public function handle(VehicleTypeEvent $event)
    {
        $vehicleType = $event->vehicleType;
        $vehicleType->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $vehicleType->name));
    }
}
