<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleRate
 *
 * @property int $id
 * @property string $engine_size
 * @property float $weekly_rate_min
 * @property float $weekly_rate_max
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleRate whereEngineSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleRate whereWeeklyRateMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\VehicleRate whereWeeklyRateMin($value)
 * @mixin \Eloquent
 */
class VehicleRate extends Model
{
    protected $fillable = [
        'engine_size', 'weekly_rate_min', 'weekly_rate_max'
    ];

    protected $table = 'vehicle_rates';

    /**
     * Get vehicles associated with the vehicle rate
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
