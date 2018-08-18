<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reservation
 *
 * @property-read \App\Vehicle $vehicle
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $made_by
 * @property int|null $rate
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereMadeBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reservation whereRate($value)
 */
class Reservation extends Model
{
    protected $fillable = ['vehicle_id', 'is_active', 'start_date', 'end_date', 'made_by', 'rate'];

    /**
     * Get vehicle associated with this reservation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

//    public function doesDatesConflict($start_date, $end_date)
//    {
////        $vehicle = Vehicle::find($this->vehicle_id);
//        $reservations = $this->vehicle->reservations->reject(function($reservation) {
//            return $reservation->id == $this->id;
//        });
//
//        $activeHire = $this->vehicle->getActiveHire();
//        $errorMessages = [];
//        foreach ($reservations as $reservation) {
//            if ($start_date < $reservation->start_date && $end_date >= $reservation->start_date) {
//                if(!is_null($errorMessages)) {
//                    $errorMessages['end_date'] = 'End date conflicts with another reservation';
//                }
//                $conflicts = true;
//            }
//            elseif ($start_date >= $reservation->start_date && $end_date <= $reservation->end_date) {
//                if(!is_null($errorMessages)) {
//                    $errorMessages['start_date'] = 'Start date conflicts with another reservation';
//                    $errorMessages['end_date'] = 'End date conflicts with another reservation';
//                }
//                $conflicts = true;
//            }
//            elseif ($start_date <= $reservation->end_date && $end_date > $reservation->end_date) {
//                if(!is_null($errorMessages)) {
//                    $errorMessages['start_date'] = 'Start date conflicts with another reservation';
//                }
//                $conflicts = true;
//            }
//        }
//    }

    public function conflicts($other, &$errorMessages = [])
    {
        $conflicts = false;
        $item_type = ($other instanceof Reservation ? 'another reservation' : 'current active hire');
        if ($this->start_date < $other->start_date && $this->end_date >= $other->start_date) {
            $errorMessages['end_date'] = 'End date conflicts with ' . $item_type;
            $conflicts = true;
        }
        elseif ($this->start_date >= $other->start_date && $this->end_date <= $other->end_date) {
            $errorMessages['start_date'] = 'Start date conflicts with '. $item_type;
            $errorMessages['end_date'] = 'End date conflicts with '. $item_type;
            $conflicts = true;
        }
        elseif ($this->start_date <= $other->end_date && $this->end_date > $other->end_date) {
            $errorMessages['start_date'] = 'Start date conflicts with '. $item_type;
            $conflicts = true;
        }

        if ($conflicts) {
            $errorMessages[($other instanceof Reservation ? 'reservation' : 'hire')] = $other;
        }

        return $conflicts;
    }
}
