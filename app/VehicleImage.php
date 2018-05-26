<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleImage
 *
 * @property int $id
 * @property string $image_uri
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int|null $vehicle_id
 * @property-read \App\Vehicle|null $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleImage whereVehicleId($value)
 * @mixin \Eloquent
 */
class VehicleImage extends Model
{
    protected $fillable = [
        'image_uri', 'vehicle_id', 'name'
    ];
    /**
     * Get vehicle associated with the image
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
