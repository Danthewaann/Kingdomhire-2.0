<?php

namespace App;

use App\Events\WeeklyRateEvent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\VehicleRate
 *
 * @property int $id
 * @property string $name
 * @property float $weekly_rate_min
 * @property float $weekly_rate_max
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereWeeklyRateMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereWeeklyRateMin($value)
 * @mixin \Eloquent
 */
class WeeklyRate extends Model
{
    protected $fillable = [
        'name', 'weekly_rate_min', 'weekly_rate_max'
    ];

    protected $table = 'weekly_rates';

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => WeeklyRateEvent::class,
        'updating' => WeeklyRateEvent::class
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
     * Get vehicles associated with the vehicle rate
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getFullName()
    {
        return $this->name.' (£'.$this->weekly_rate_min.'-£'.$this->weekly_rate_max.')';
    }
}
