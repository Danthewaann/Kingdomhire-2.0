<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleImage;
use App\VehicleType;

class PagesController extends Controller
{
    public function vehicles()
    {
        return view('public.vehicles', [
            'vehicleTypes' => VehicleType::with(['vehicles'])->get()
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
