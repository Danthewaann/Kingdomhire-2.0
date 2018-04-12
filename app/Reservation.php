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
    protected $fillable = ['vehicle_id', 'is_active', 'start_date', 'end_date'];

    /**
     * Get vehicle associated with this reservation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
