<?php

namespace App;

use App\Events\VehicleFuelTypeEvent;
use Illuminate\Database\Eloquent\Model;

class VehicleFuelType extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'vehicle_fuel_types';

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => VehicleFuelTypeEvent::class,
        'updating' => VehicleFuelTypeEvent::class
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get vehicles associated with the vehicle fuel type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
