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
        $inactiveVehicles = Vehicle::onlyTrashed()->get();
        $allVehicles = Vehicle::withTrashed()->get();
        $pastHires = Hire::whereIsActive(false)->get()->sortBy('end_date');
        $activeHires = Hire::whereIsActive(true)->get()->sortBy('end_date');
        ChartGenerator::drawReservationsBarChart($activeVehicles);
        ChartGenerator::drawOverallPastHiresBarChart($pastHires, $allVehicles);
        $vehicleTypes = VehicleType::with(['vehicles' => function ($q) {
            $q->withTrashed();
        }])->get();

        return view('admin.home', [
            'vehicleTypes' => $vehicleTypes,
            'activeVehicles' => $activeVehicles,
            'inactiveVehicles' => $inactiveVehicles,
            'pastHires' => $pastHires,
            'activeHires' => $activeHires,
            'reservations' => Reservation::all(),
            'rates' => WeeklyRate::all(),
            'gantt' => ChartGenerator::drawVehiclesActiveHiresGanttChart($activeVehicles)
        ]);
    }
}

