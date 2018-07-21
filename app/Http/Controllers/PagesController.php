<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleImage;

class PagesController extends Controller
{
    public function vehicles()
    {
        return view('public.vehicles', [
            'vehicles' => Vehicle::whereIsActive(true)->get()
        ]);
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function home()
    {
        return view('public.home', [
            'images' => VehicleImage::inRandomOrder()->get()
        ]);
    }
}
