<?php

namespace App\Observers;

use App\VehicleGearType;

class VehicleGearTypeObserver
{
    /**
     * Handle the vehicle gear type "saving" event.
     *
     * @param  \App\VehicleGearType  $vehicleGearType
     * @return void
     */
    public function saving(VehicleGearType $vehicleGearType)
    {
        // Set the slug of the fuel type to be its name with special characters replaced with ' ' 
        $vehicleGearType->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $vehicleGearType->name));
    }
}
