<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleImage;
use App\VehicleType;

class PublicController extends Controller
{
    public function vehicles()
    {
        $activeVehicles = [];
        $vehiclesWithType = Vehicle::where('vehicle_type_id', '!=', null)->get();
        $vehiclesWithNoType = Vehicle::whereVehicleTypeId(null)->get();

        foreach ($vehiclesWithNoType as $vehicle) {
            array_push($activeVehicles, $vehicle);
        }

        foreach ($vehiclesWithType as $vehicle) {
            array_push($activeVehicles, $vehicle);
        }
        
        $activeVehicles = collect($activeVehicles);

        return view('public.vehicles', [
            'activeVehicles' => $activeVehicles,
            'vehiclesWithType' => $vehiclesWithType,
            'vehiclesWithNoType' => $vehiclesWithNoType,
            'vehicleTypes' => VehicleType::all(),
            'vehicleCount' => Vehicle::count()
        ]);
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function home()
    {
        return view('public.home');
    }
}
