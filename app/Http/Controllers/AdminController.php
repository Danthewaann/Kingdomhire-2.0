<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Hire;
use App\Vehicle;
use App\Reservation;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeVehicles = Vehicle::all();
        $inactiveVehicles = Vehicle::onlyTrashed()->get();
        $allVehicles = Vehicle::withTrashed()->get();
        $pastHires = Hire::whereIsActive(false)->get()->sortBy('end_date');
        $reservations = Reservation::all();
        ChartGenerator::drawReservationsBarChart($activeVehicles);
        $maxAmountOfHiresPerMonth = ChartGenerator::drawOverallPastHiresBarChart($pastHires, $allVehicles);

        return view('admin.admin-dashboard', [
            'activeVehicles' => $activeVehicles,
            'inactiveVehicles' => $inactiveVehicles,
            'pastHires' => $pastHires,
            'reservations' => $reservations,
            'rates' => WeeklyRate::all(),
            'gantt' => ChartGenerator::drawVehiclesActiveHiresGanttChart($activeVehicles),
            'maxAmountOfHiresPerMonth' => $maxAmountOfHiresPerMonth
        ]);
    }
}

