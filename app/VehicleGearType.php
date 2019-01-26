<?php

namespace App;

use App\Events\VehicleGearTypeEvent;
use Illuminate\Database\Eloquent\Model;

class VehicleGearType extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'vehicle_gear_types';

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => VehicleGearTypeEvent::class,
        'updating' => VehicleGearTypeEvent::class
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
     * Get vehicles associated with the vehicle gear type
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
