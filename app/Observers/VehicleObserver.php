<?php

namespace App\Observers;

use App\Vehicle;

class VehicleObserver
{
    /**
     * Handle the vehicle "saving" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function saving(Vehicle $vehicle)
    {
        // Create a unique id for the vehicle if it is empty
        if ($vehicle->name == null) {
            $vehicle->name = Vehicle::createUniqueId();
        }
        // Set the slug of the vehicle to be its make and model + generated id 
        $vehicle->slug = str_slug($vehicle->make_model.' '.$vehicle->name);
    }

    /**
     * Handle the vehicle "restoring" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function restoring(Vehicle $vehicle)
    {
        // Set vehicle status to available
        $vehicle->update(['status' => 'Available']);
    }

    /**
     * Handle the vehicle "deleting" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function deleting(Vehicle $vehicle)
    {
        // Set vehicle status to unavailable
        $vehicle->update(['status' => 'Unavailable']);
        // Delete all reservations linked to vehicle if it has any
        $vehicle->reservations()->delete();
        // Delete the active hire for the vehicle if it has one
        $vehicle->hires()->where('is_active', true)->delete();
    }

    /**
     * Handle the vehicle "force deleting" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function forceDeleting(Vehicle $vehicle)
    {
        // Delete all images linked to the vehicle
        $vehicle->deleteImages();
    }
}
