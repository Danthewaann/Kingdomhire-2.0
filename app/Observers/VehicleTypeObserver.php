<?php

namespace App\Observers;

use App\VehicleType;

class VehicleTypeObserver
{
    /**
     * Handle the vehicle type "saving" event.
     *
     * @param  \App\VehicleType  $vehicleType
     * @return void
     */
    public function saving(VehicleType $vehicleType)
    {
        // Set the slug of the fuel type to be its name with special characters replaced with ' ' 
        $vehicleType->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $vehicleType->name));
    }
}
