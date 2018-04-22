<?php

namespace App;

use Illuminate\Support\Facades\DB;

class DBQuery
{
    public static function getVehicles()
    {
        return Vehicle::with(['reservations', 'hires', 'rate'])->get();
    }

    public static function getReservations()
    {
        return DB::table('reservations')->get();
    }

    public static function getHires()
    {
        return DB::table('hires')->get();
    }

    public static function getVehicleRates()
    {
        return DB::table('vehicle_rates')->get();
    }
}