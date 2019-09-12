<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleType
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VehicleType extends Model
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
     * @var array
     */
    protected $table = 'vehicle_types';

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
     * Get vehicles associated with the vehicle type.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
