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

    public static function doesReservationConflict($start_date, $end_date, &$reservations, &$errorMessages, Hire &$activeHire = null)
    {
        foreach ($reservations as $reservation) {
            if ($start_date < $reservation->start_date && $end_date >= $reservation->start_date) {
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            }
            elseif ($start_date >= $reservation->start_date && $end_date <= $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            }
            elseif ($start_date <= $reservation->end_date && $end_date > $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                break;
            }
        }

        if ($activeHire != null) {
            if ($start_date < $activeHire->start_date && $end_date >= $activeHire->start_date) {
                $errorMessages['end_date'] = 'end date conflicts with current active hire';
            }
            elseif ($start_date >= $activeHire->start_date && $end_date <= $activeHire->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with current active hire';
                $errorMessages['end_date'] = 'end date conflicts with current active hire';
            }
            elseif ($start_date <= $activeHire->end_date && $end_date > $activeHire->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with current active hire';
            }
        }

        return count($errorMessages) > 0;
    }

    public static function doesHireConflict($start_date, $end_date, &$reservations, &$errorMessages)
    {
        foreach ($reservations as $reservation) {
            if ($start_date < $reservation->start_date && $end_date >= $reservation->start_date) {
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            }
            elseif ($start_date >= $reservation->start_date && $end_date <= $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            }
            elseif ($start_date <= $reservation->end_date && $end_date > $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                break;
            }
        }

        return count($errorMessages) > 0;
    }
}