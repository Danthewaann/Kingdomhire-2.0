<?php

namespace App\Observers;

use App\VehicleFuelType;

class VehicleFuelTypeObserver
{
    /**
     * Handle the vehicle fuel type "saving" event.
     *
     * @param  \App\VehicleFuelType  $vehicleFuelType
     * @return void
     */
    public function saving(VehicleFuelType $vehicleFuelType)
    {
        // Set the slug of the fuel type to be its name with special characters replaced with ' ' 
        $vehicleFuelType->slug = str_slug(preg_replace('/[^a-zA-Z0-9]/', ' ', $vehicleFuelType->name));
    }
}
