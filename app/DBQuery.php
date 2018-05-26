<?php

namespace App;

class DBQuery
{
    public static function getAllVehicles()
    {
        return Vehicle::with(['reservations', 'hires', 'rate', 'images'])->get();
    }

    public static function getActiveVehicles()
    {
        return Vehicle::with(['reservations', 'hires', 'rate', 'images'])->where('is_active', '=', true)->get();
    }

    public static function getReservations()
    {
        return Reservation::with('vehicle')->get();
    }

    public static function getAllHires()
    {
        return Hire::with('vehicle')->get();
    }

    public static function getActiveHires()
    {
        return Hire::with('vehicle')->where('is_active', '=', true)->get();
    }

    public static function getVehicleRates()
    {
        return VehicleRate::all();
    }

    public static function getVehicle($make, $model, $id)
    {
        return Vehicle::with(['reservations', 'hires', 'rate', 'images'])
            ->where([['make', '=', $make], ['model', '=', $model], ['id', '=', $id]])
            ->get()->first();
    }

    public static function getVehicleReservations($id)
    {
        return Reservation::where('vehicle_id', '=', $id)->get();
    }

    public static function getVehicleReservationsNotEqual($id, $reservation_id)
    {
        return Reservation::where([['id', '!=', $reservation_id], ['vehicle_id', '=', $id]])->get();
    }

    public static function getVehicleHires($make, $model, $id)
    {
        return Vehicle::with('hires')
            ->where([['make', '=', $make], ['model', '=', $model], ['id', '=', $id]])
            ->get()->first()->hires;
    }

    public static function getVehicleWithoutId($make, $model)
    {
        return Vehicle::with(['reservations', 'hires', 'rate', 'images'])
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->get()->first();
    }

    public static function getVehicleRate($engine_size)
    {
        return VehicleRate::where('engine_size', '=', $engine_size)->get()->first();
    }

    public static function getReservation($id)
    {
        return Reservation::where('id', '=', $id)->get()->first();
    }

    public static function getHire($id)
    {
        return Hire::where('id', '=', $id)->get()->first();
    }

    public static function doesReservationConflict($start_date, $end_date, $reservations, Hire $activeHire = null, &$errorMessages)
    {
        foreach ($reservations as $reservation) {
            if ($start_date < $reservation->start_date && $end_date >= $reservation->start_date) {
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            } elseif ($start_date >= $reservation->start_date && $end_date <= $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            } elseif ($start_date <= $reservation->end_date && $end_date > $reservation->end_date) {
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

    public static function doesHireConflict($start_date, $end_date, $reservations, &$errorMessages)
    {
        foreach ($reservations as $reservation) {
            if ($start_date < $reservation->start_date && $end_date >= $reservation->start_date) {
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            } elseif ($start_date >= $reservation->start_date && $end_date <= $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                $errorMessages['end_date'] = 'end date conflicts with another reservation';
                break;
            } elseif ($start_date <= $reservation->end_date && $end_date > $reservation->end_date) {
                $errorMessages['start_date'] = 'start date conflicts with another reservation';
                break;
            }
        }

        return count($errorMessages) > 0;
    }
}