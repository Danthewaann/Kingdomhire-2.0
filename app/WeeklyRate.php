<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WeeklyRate
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property float $weekly_rate_min
 * @property float $weekly_rate_max
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Vehicle[] $vehicles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereWeeklyRateMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WeeklyRate whereWeeklyRateMin($value)
 * @mixin \Eloquent
 */
class WeeklyRate extends Model
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'name', 'weekly_rate_min', 'weekly_rate_max'
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['name', 'weekly_rate_min', 'weekly_rate_max'];

    /**
     * The table name for the model.
     * 
     * @var array
     */
    protected $table = 'weekly_rates';

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
     * Get vehicles associated with the vehicle rate.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    /**
     * Returns the full name for the weekly rate.
     * Example of what is returned `Small (£50-£100)`.
     * `
     * @return string
     */
    public function getFullNameAttribute()
    {
        return sprintf('%s (£%d-£%d)', $this->name, $this->weekly_rate_min, $this->weekly_rate_max);
    }
}
