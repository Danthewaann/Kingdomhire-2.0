<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    /**
     * Get vehicle associated with the image
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
