<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Hire
 *
 * @property-read \App\Vehicle $vehicle
 * @mixin \Eloquent
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property int $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $vehicle_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereVehicleId($value)
 * @property string|null $hired_by
 * @property int|null $rate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereHiredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Hire whereRate($value)
 */
class Hire extends Model
{
    protected $fillable = ['vehicle_id', 'is_active', 'start_date', 'end_date', 'hired_by', 'rate'];

    /**
     * Get vehicle associated with this hire
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
