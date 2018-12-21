<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleGearType extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'vehicle_gear_types';

    /**
     * Get vehicles associated with the vehicle gear type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
