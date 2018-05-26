<?php

namespace App\Http\Controllers;

use App\Hire;
use App\Vehicle;
use App\Reservation;
use App\VehicleRate;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-dashboard', [
            'vehicles' => Vehicle::whereIsActive(true)->get(),
            'reservations' => Reservation::orderBy('end_date')->get(),
            'hires' => Hire::whereIsActive(true)->get(),
            'rates' => VehicleRate::all()
        ]);
    }
}

