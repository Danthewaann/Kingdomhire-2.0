<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleFuelType extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'vehicle_fuel_types';

    /**
     * Get vehicles associated with the vehicle fuel type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
