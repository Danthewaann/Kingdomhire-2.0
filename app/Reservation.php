<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reservation
 *
 * @property-read \App\Vehicle $vehicle
 * @mixin \Eloquent
 */
class Reservation extends Model
{
    /**
     * Get vehicle associated with this reservation
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
