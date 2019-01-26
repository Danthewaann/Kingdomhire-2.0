<?php

namespace App\Listeners;

use App\Events\VehicleGearTypeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleGearTypeListener
{
    /**
     * Handle the event.
     *
     * @param  VehicleGearTypeEvent  $event
     * @return void
     */
    public function handle(VehicleGearTypeEvent $event)
    {
        $vehicleGearType = $event->vehicleGearType;
        $vehicleGearType->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $vehicleGearType->name));
    }
}
