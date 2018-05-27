<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
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
        $activeVehicles = Vehicle::whereIsActive(true)->get();
        ChartGenerator::drawReservationsBarChart($activeVehicles);

        return view('admin.admin-dashboard', [
            'vehicles' => $activeVehicles,
            'reservations' => Reservation::orderBy('end_date')->get(),
            'hires' => Hire::whereIsActive(true)->get(),
            'rates' => VehicleRate::all()
        ]);
    }
}

