<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Http\Requests\HireRequest;
use App\Vehicle;
use App\Hire;
use Session;

class HiresController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeHires = Hire::whereIsActive(true)->get()->sortByDesc('end_date');
        $inactiveHires = Hire::whereIsActive(false)->get()->sortByDesc('end_date');
        $yearlyHires = Hire::getYearlyHires();
        $activeVehicles = Vehicle::all();
        $allVehicles = Vehicle::withTrashed()->get();

        ChartGenerator::drawOverallPastHiresBarChart($inactiveHires, $allVehicles);

        return view('admin.admin-hires', [
            'activeHires' => $activeHires,
            'inactiveHires' => $inactiveHires,
            'yearlyHires' => $yearlyHires,
            'vehicles' => $allVehicles,
            'gantt' => ChartGenerator::drawVehiclesActiveHiresGanttChart($activeVehicles)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function edit(Hire $hire)
    {
        return view('admin.hire.edit', [
            'vehicle' => $hire->vehicle,
            'hire' => $hire
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HireRequest $request
     * @param  \App\Hire $hire
     * @return \Illuminate\Http\Response
     */
    public function update(HireRequest $request, Hire $hire)
    {
        $hire->update($request->all());

        Session::flash('status', [
            'hire' => 'Successfully updated active hire!'
        ]);

        return back();
    }
}
