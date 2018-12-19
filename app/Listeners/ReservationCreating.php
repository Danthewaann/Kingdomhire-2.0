<?php

namespace App\Listeners;

use App\Events\ReservationCreating as ReservationCreatingEvent;
use App\Reservation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationCreating
{
    /**
     * Handle the event.
     *
     * @param  ReservationCreatingEvent  $event
     * @return void
     */
    public function handle(ReservationCreatingEvent $event)
    {
        $reservation = $event->reservation;
        if ($reservation->name == '') {
            $reservation->name = Reservation::createUniqueId($reservation->vehicle->id);
        }
    }
}
