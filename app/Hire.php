<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Hire
 *
 * @property-read \App\Vehicle $vehicle
 * @mixin \Eloquent
 */
class Hire extends Model
{
    protected $fillable = ['vehicle_id', 'is_active', 'start_date', 'end_date'];

    /**
     * Get vehicle associated with this hire
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
