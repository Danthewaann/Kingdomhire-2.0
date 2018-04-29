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

    public static function getVehicle($make, $model, $id)
    {
        return Vehicle::with(['reservations', 'hires', 'rate', 'images'])
            ->where([['make', '=', $make], ['model', '=', $model], ['id', '=', $id]])
            ->get()->first();
    }

    public static function getVehicleRate($engine_size)
    {
        return DB::table('vehicle_rates')
            ->where('engine_size', '=', $engine_size)
            ->get()->first();
    }

    public static function getReservation($id)
    {
        return DB::table('reservations')
            ->where('id', '=', $id)
            ->get()->first();
    }

    public static function getHire($id)
    {
        return DB::table('hires')
            ->where('id', '=', $id)
            ->get()->first();
    }
}