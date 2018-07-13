<?php

namespace App;

class DBQuery
{
    public static function getVehicleWithoutId($make, $model)
    {
        return Vehicle::with(['reservations', 'hires', 'rate', 'images'])
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->get()->first();
    }

    public static function doesDatesConflict($vehicle_id, $start_date, $end_date, &$errorMessages, $edit_id = null, $checkActiveHire = false)
    {
        $reservations = Reservation::all()->where('vehicle_id', '=', $vehicle_id);
        $activeHire = Vehicle::find($vehicle_id)->getActiveHire();
        if($edit_id != null) {
            $reservations = $reservations->reject(function($reservation) use ($edit_id) {
                return $reservation->id == $edit_id;
            });
        }

        $reservationErrorMessages = [];
        foreach ($reservations as $reservation) {
            if(self::datesConflict($reservation, $start_date, $end_date, $reservationErrorMessages)) {
                break;
            }
        }

        $hireErrorMessages = [];
        if ($activeHire != null && $checkActiveHire == true) {
            self::datesConflict($activeHire, $start_date, $end_date, $hireErrorMessages);
        }

        $errorMessages = array_merge($reservationErrorMessages, $hireErrorMessages);
        return count($errorMessages) > 0;
    }

    public static function datesConflict($item, $start_date, $end_date, &$errorMessages = null)
    {
        $conflicts = false;
        $item_type = ($item instanceof Reservation ? 'another reservation' : 'current active hire');
        if ($start_date < $item->start_date && $end_date >= $item->start_date) {
            if(!is_null($errorMessages)) {
                $errorMessages['end_date'] = 'End date conflicts with ' . $item_type;
            }
            $conflicts = true;
        }
        elseif ($start_date >= $item->start_date && $end_date <= $item->end_date) {
            if(!is_null($errorMessages)) {
                $errorMessages['start_date'] = 'Start date conflicts with ' . $item_type;
                $errorMessages['end_date'] = 'End date conflicts with ' . $item_type;
            }
            $conflicts = true;
        }
        elseif ($start_date <= $item->end_date && $end_date > $item->end_date) {
            if(!is_null($errorMessages)) {
                $errorMessages['start_date'] = 'Start date conflicts with ' . $item_type;
            }
            $conflicts = true;
        }

        if(!is_null($errorMessages)) {
            if (count($errorMessages) > 0) {
                $errorMessages[($item instanceof Reservation ? 'reservation' : 'hire')] = $item;
            }
        }

        return $conflicts;
    }
}