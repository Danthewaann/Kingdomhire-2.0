<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Hire;
use App\Vehicle;
use App\Reservation;
use App\VehicleType;
use App\WeeklyRate;

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
     * Show the main admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $activeVehicles = Vehicle::all();
        $allVehicles = Vehicle::withTrashed()->get();
        $pastHires = Hire::whereIsActive(false)->get()->sortBy('end_date');
        $activeHires = Hire::whereIsActive(true)->get()->sortBy('end_date');
        $yearlyHires = Hire::getYearlyHires();
        ChartGenerator::drawReservationsBarChart($activeVehicles);
        ChartGenerator::drawOverallPastHiresBarChart($pastHires, $allVehicles);

        return view('admin.admin-home', [
            'vehicles' => $activeVehicles,
            'yearlyHires' => $yearlyHires,
            'inactiveHires' => $pastHires,
            'activeHires' => $activeHires,
            'reservations' => Reservation::all(),
            'gantt' => ChartGenerator::drawVehiclesActiveHiresGanttChart($activeVehicles)
        ]);
    }
}

