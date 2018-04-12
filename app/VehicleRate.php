<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleRate extends Model
{
    protected $fillable = [
        'engine_size', 'weekly_rate_min', 'weekly_rate_max'
    ];

    protected $table = 'vehicle_rates';

    /**
     * Get vehicle associated with the vehicle rate
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
