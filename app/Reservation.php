<?php

namespace App;

/**
 * App\Reservation
 *
 * @property int $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $vehicle_id
 * @property-read array $conflict_data
 * @property-read bool $conflicts
 * @property-read \App\Vehicle $vehicle
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereVehicleId($value)
 * @mixin \Eloquent
 */
class Reservation extends ConflictableModel
{
    /**
     * Conflict message string.
     * 
     * @var string
     */
    protected $conflictMessage = 'conflicts with another reservation';

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['vehicle_id', 'start_date', 'end_date'];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['name', 'start_date', 'end_date'];

    /**
     * Get vehicle associated with this reservation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Returns true if the reservation start date is equal to or less than todays date,
     * meaning the reservation can be converted to a hire, otherwise return false.
     * 
     * @return boolean
     */
    public function canConvertToHire()
    {
        return $this->start_date <= date('Y-m-d');
    }
}
