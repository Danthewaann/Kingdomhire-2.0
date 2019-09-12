<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleFuelType
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleFuelType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VehicleFuelType extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['name'];

    /**
     * The table name for the model.
     * 
     * @var string
     */
    protected $table = 'vehicle_fuel_types';

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
     * Get vehicles associated with the vehicle fuel type.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
