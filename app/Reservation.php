<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
