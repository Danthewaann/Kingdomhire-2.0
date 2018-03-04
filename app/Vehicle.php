<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Vehicle
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Hire[] $hires
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @mixin \Eloquent
 */
class Vehicle extends Model
{
    /**
     * Get reservations for the vehicle
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    /**
     * Get hires for the vehicle
     */
    public function hires()
    {
        return $this->hasMany('App\Hire');
    }
}
