<?php

namespace App;

use App\Events\ReservationCreating;
/**
 * App\Reservation
 *
 * @property-read \App\Vehicle $vehicle
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name
 * @property string $start_date
 * @property string $end_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $vehicle_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereName($value)
 */
class Reservation extends ConflictableModel
{
    protected $fillable = ['vehicle_id', 'is_active', 'start_date', 'end_date', 'name'];

    protected $conflict_message = 'conflicts with another reservation';

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => ReservationCreating::class,
    ];

    /**
     * Get vehicle associated with this reservation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function __toString()
    {
        return "reservation";
    }

    /**
     * Create a unique reservation id that doesn't
     * conflict with any reservation id that exists
     * in the database
     *
     * @param int vehicle_id
     * @param int $length character length of generated id
     * @return string the newly generated id
     */
    public static function createUniqueId($vehicle_id, $length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $id = $vehicle_id.'-'.$randomString;
        $reservation_ids = Reservation::all()->pluck('name')->toArray();
        if (in_array($id, $reservation_ids)) {
            return Reservation::createUniqueId($vehicle_id);
        }

        return $id;
    }
}
