<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
