<?php

namespace App\Listeners;

use App\Events\HireCreating as HireCreatingEvent;
use App\Vehicle;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HireCreating
{
    /**
     * Handle the event.
     *
     * @param  HireCreatingEvent  $event
     * @return void
     */
    public function handle(HireCreatingEvent $event)
    {
        $hire = $event->hire;
//        $vehicle = Vehicle::find($hire->vehicle_id);
        if ($hire->name == '') {
            $hire->name = Hire::createUniqueId($hire->vehicle->id);
//            $hire->name = $hire->vehicle->id.'-'.$id;
        }
    }
}
