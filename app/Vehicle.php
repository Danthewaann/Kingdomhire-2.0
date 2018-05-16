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
 */
class Vehicle extends Model
{
    protected $fillable = [
        'make', 'model', 'fuel_type', 'gear_type', 'seats',
        'status', 'type', 'image_path', 'vehicle_rate_id'
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
     * Get price rate for the vehicle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo(VehicleRate::class, 'vehicle_rate_id');
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

    public function getActiveHire()
    {
        return DB::table('hires')
          ->where([['vehicle_id', '=', $this->id], ['is_active', '=', true]])
          ->get()->first();
    }

  public function getInactiveHires()
  {
      return DB::table('hires')
        ->where([['vehicle_id', '=', $this->id], ['is_active', '=', false]])
        ->get();
  }
}
