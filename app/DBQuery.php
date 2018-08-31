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
}