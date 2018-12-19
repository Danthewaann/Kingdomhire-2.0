<?php

namespace App\Listeners;

use App\Events\HireCreating as HireCreatingEvent;
use App\Hire;
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
        if ($hire->name == '') {
            $hire->name = Hire::createUniqueId($hire->vehicle->id);
        }
    }
}
