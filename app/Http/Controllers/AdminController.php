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
        $vehicles = Vehicle::all();
        $activeHires = Hire::whereIsActive(true)->get();
        $pastHires = Hire::whereIsActive(false)->get()->sortBy('end_date');
        $reservations = Reservation::all()->sortByDesc('start_date')->sortBy('end_date');
        ChartGenerator::drawReservationsBarChart($vehicles);
        ChartGenerator::drawOverallPastHiresBarChart($pastHires);

        return view('admin.admin-dashboard', [
            'vehicles' => $vehicles,
            'activeHires' => $activeHires,
            'pastHires' => $pastHires,
            'reservations' => $reservations,
            'rates' => VehicleRate::all()
        ]);
    }
}

