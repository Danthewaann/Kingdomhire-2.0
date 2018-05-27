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

    public static function doesDatesConflict($vehicle_id, $start_date, $end_date, &$errorMessages, $edit_id = null)
    {
        $reservations = Reservation::all()->where('vehicle_id', '=', $vehicle_id);
        $activeHire = Vehicle::find($vehicle_id)->getActiveHire();
        if($edit_id != null) {
            $reservations = $reservations->reject(function($reservation) use ($edit_id) {
                return $reservation->id == $edit_id;
            });
        }

        foreach ($reservations as $reservation) {
            if ($start_date < $reservation->start_date && $end_date >= $reservation->start_date) {
                $errorMessages['end_date'] = 'End date conflicts with another reservation';
            }
            elseif ($start_date >= $reservation->start_date && $end_date <= $reservation->end_date) {
                $errorMessages['start_date'] = 'Start date conflicts with another reservation';
                $errorMessages['end_date'] = 'End date conflicts with another reservation';
            }
            elseif ($start_date <= $reservation->end_date && $end_date > $reservation->end_date) {
                $errorMessages['start_date'] = 'Start date conflicts with another reservation';
            }

            if(count($errorMessages) > 0) {
                $errorMessages['conflict']['start_date'] = 'Start date = '.$reservation->start_date;
                $errorMessages['conflict']['end_date'] = 'End date = '.$reservation->end_date;
                return true;
            }
        }

        if ($activeHire != null) {
            if ($start_date < $activeHire->start_date && $end_date >= $activeHire->start_date) {
                $errorMessages['end_date'] = 'End date conflicts with current active hire';
            }

            if(count($errorMessages) > 0) {
                $errorMessages['conflict']['start_date'] = 'Start date = '.$activeHire->start_date;
                $errorMessages['conflict']['end_date'] = 'End date = '.$activeHire->end_date;
                return true;
            }
        }

        return false;
    }
}