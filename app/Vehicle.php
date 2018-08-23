<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Vehicle
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Hire[] $hires
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @mixin \Eloquent
 * @property int $id
 * @property string $make
 * @property string $model
 * @property string $fuel_type
 * @property string $gear_type
 * @property int $seats
 * @property int $is_active
 * @property string $status
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int|null $vehicle_rate_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\VehicleImage[] $images
 * @property-read \App\WeeklyRate|null $rate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereFuelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereGearType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereMake($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereVehicleRateId($value)
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $weekly_rate_id
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Vehicle whereWeeklyRateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Vehicle withoutTrashed()
 */
class Vehicle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'make', 'model', 'fuel_type', 'gear_type', 'seats',
        'status', 'type', 'image_path', 'weekly_rate_id'
    ];

    public static $types = [
        'Hatchback',
        '4-by-4',
        'Large Van',
        'Small Van',
        'People Carrier',
        '4-door Saloon'
    ];

    public static $status = [
        'Available',
        'Unavailable',
        'Out for hire'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get reservations for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Get hires for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hires()
    {
        return $this->hasMany(Hire::class);
    }

    /**
     * Get weekly price rate for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo(WeeklyRate::class, 'weekly_rate_id');
    }

    /**
     * Get images associated with the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }

    /**
     * Get the vehicle name (make + model)
     * @return string
     */
    public function name()
    {
        return $this->make.' '.$this->model;
    }

    public function getTotalProfit()
    {
       return $this->hires->sum('rate');
    }

    public function getYearlyProfits()
    {
        $years = [];
        foreach ($this->hires as $hire) {
            $year = date('Y', strtotime($hire->end_date));
            if (!array_key_exists($year, $years)) {
                $years[$year] = $hire->rate;
            }
            else {
                $years[$year] += $hire->rate;
            }
        }

        return collect($years)->sortKeysDesc();
    }

    public function getMonthlyProfits()
    {
        $years = [];
        $months = [
            'Jan' => 0,
            'Feb' => 0,
            'Mar' => 0,
            'Apr' => 0,
            'May' => 0,
            'Jun' => 0,
            'Jul' => 0,
            'Aug' => 0,
            'Sep' => 0,
            'Oct' => 0,
            'Nov' => 0,
            'Dec' => 0
        ];
        foreach ($this->hires as $hire) {
            $month = date('M', strtotime($hire->end_date));
            $year = date('Y', strtotime($hire->end_date));
            if (!array_key_exists($year, $years)) {
                $years[$year] = $months;
            }
            $years[$year][$month] += $hire->rate;
        }

        return collect($years)->sortKeysDesc();
    }

    public function getNextReservation()
    {
        return $this->reservations->sortBy('end_date')->first();
    }

    public function hasActiveHire()
    {
        return $this->getActiveHire() != null;
    }

    public function getActiveHire()
    {
        return $this->hires->where('is_active', '=', true)->first();
    }

    public function getInactiveHires()
    {
        return $this->hires->where('is_active', '=', false);
    }

    public function getCompleteHires()
    {
        return $this->getInactiveHires()->where('rate', '!=', null);
    }

    public function getIncompleteHires()
    {
        return $this->getInactiveHires()->where('rate', '=', null);
    }
}
