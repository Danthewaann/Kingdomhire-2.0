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
    /**
     * Get vehicle associated with this hire
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
