<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
 */
class Vehicle extends Model
{
    protected $fillable = [
        'make', 'model', 'fuel_type', 'gear_type', 'seats',
        'status', 'type', 'image_path', 'weekly_rate_id'
    ];

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
