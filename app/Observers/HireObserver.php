<?php

namespace App\Observers;

use App\Hire;

class HireObserver
{
    /**
     * Handle the hire "saving" event.
     *
     * @param  \App\Hire  $hire
     * @return boolean
     */
    public function saving(Hire $hire)
    {
        $vehicle = $hire->vehicle;

        // Check if the hire conflicts with any other reservation/hire for its vehicle
        $reservationsAndHires = $vehicle->getReservationsAndHires(
            [], (($hire->exists) ? [$hire->id] : [])
        );
        foreach ($reservationsAndHires as $other) {
            if ($hire->conflictsWith($other)) {
                return false;
            }
        }
        // Create unique id for hire if it doesn't have one
        if ($hire->name == null) {
            $hire->name = Hire::createUniqueId($vehicle);
        }
        // Determine if the newly created hire is active or not
        if ($hire->end_date <= date('Y-m-d')) {
            $hire->is_active = false;
        }
        else {
            // If it is the active hire, update vehicle status to reflect this
            $vehicle->update(['status' => 'Out for hire']);
        }
        return true;
    }

    /**
     * Handle the hire "deleting" event.
     *
     * @param  \App\Hire  $hire
     * @return void
     */
    public function deleting(Hire $hire)
    {
        // If the hire we are deleting is an active hire,
        // set the the status of the vehicle linked to it to 'Available'
        if ($hire->is_active) {
            $hire->vehicle->update(['status' => 'Available']);
        }
    }
}
