<?php

namespace App\Listeners;

use App\Events\VehicleFuelTypeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VehicleFuelTypeListener
{
    /**
     * Handle the event.
     *
     * @param VehicleFuelTypeEvent $event
     * @return void
     */
    public function handle(VehicleFuelTypeEvent $event)
    {
        $vehicleFuelType = $event->vehicleFuelType;
        $vehicleFuelType->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $vehicleFuelType->name));
    }
}
