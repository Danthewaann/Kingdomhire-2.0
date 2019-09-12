<?php

namespace App\Observers;

use App\Reservation;
use App\Hire;

class ReservationObserver
{
    /**
     * Handle the reservation "saving" event.
     *
     * @param  \App\Reservation  $reservation
     * @return boolean
     */
    public function saving(Reservation $reservation)
    {
        // Check if the reservation conflicts with any other reservation/hire for its vehicle.
        $vehicle = $reservation->vehicle;
        $reservationsAndHires = $vehicle->getReservationsAndHires(
            (($reservation->exists) ? [$reservation->id] : [])
        );
        foreach ($reservationsAndHires as $other) {
            if ($reservation->conflictsWith($other)) {
                return false;
            }
        }
        // Create unique id for reservation if it doesn't have one.
        if ($reservation->name == null) {
            $reservation->name = Reservation::createUniqueId($vehicle->name);
        }
        // Determine if created/updated reservation should be a hire.
        // If the reservation is indeed a hire (start_date is a date less than or equal to today),
        // we save the hire here then return false, which signals to not save the inital 
        // reservation, as it has been converted into a hire.
        if ($reservation->canConvertToHire()) {
            // Create and save hire with atributes from the original reservation.
            (new Hire($reservation->getAttributes()))->save();
            // Delete reservation if it already exists in the database.
            if ($reservation->exists) {
                $reservation->delete();
            }
            return false;
        }
        return true;
    }
}
