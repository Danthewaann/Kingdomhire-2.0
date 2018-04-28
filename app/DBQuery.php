<?php

namespace App;

use Illuminate\Support\Facades\DB;

class DBQuery
{
    public static function getAllVehicles()
    {
        return Vehicle::with(['reservations', 'hires', 'rate'])->get();
    }

    public static function getActiveVehicles()
    {
        return Vehicle::with(['reservations', 'hires', 'rate'])->where('is_active', '=', true)->get();
    }

    public static function getReservations()
    {
        return DB::table('reservations')->get();
    }

    public static function getAllHires()
    {
        return DB::table('hires')->get();
    }

    public static function getActiveHires()
    {
        return DB::table('hires')->where('is_active', '=', true)->get();
    }

    public static function getVehicleRates()
    {
        return DB::table('vehicle_rates')->get();
    }
}