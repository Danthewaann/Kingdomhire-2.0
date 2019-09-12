<?php

namespace App\Http\Controllers;

use App\DataVisualisation\ChartGenerator;
use App\DataVisualisation\ReportGenerator;
use App\Hire;
use App\Vehicle;
use App\Reservation;
use Session;

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
    public function home()
    {
        Session::forget('url');
        
        $vehicles = Vehicle::all();
        $hires = Hire::all();
        $reservations = Reservation::all();
        $pastHires = $hires->where('is_active', false);
        $activeHires = $hires->where('is_active', true);
        $yearlyHires = Hire::getYearlyHires($pastHires);
        $activeHiresGanttChart = ChartGenerator::drawVehiclesActiveHiresGanttChart($vehicles);
        ChartGenerator::drawReservationsBarChart($vehicles);
        ChartGenerator::drawOverallHiresBarChart($hires);

        return view('admin.admin-home', [
            'vehicles' => $vehicles,
            'yearlyHires' => $yearlyHires,
            'inactiveHires' => $pastHires,
            'activeHires' => $activeHires,
            'reservations' => $reservations,
            'gantt' => $activeHiresGanttChart
        ]);
    }

    /**
     * Generate and return a PdfReport of all hires per vehicle
     *
     * @return PdfReport|\Illuminate\Http\Response
     */
    public function generateHiresPerVehicleReport()
    {
        $report = ReportGenerator::generateHiresPerVehicleReport();
        if($report != null) {
            return $report->stream();
        }
        else {
            Session::flash('status', [
                'Failed to generate PDF report!',
                'No vehicles or hires found to generate report with!'
            ]);
            return back();
        }
    }
}

