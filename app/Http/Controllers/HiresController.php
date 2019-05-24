<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Http\Requests\HireRequest;
use App\Vehicle;
use App\Hire;
use Session;
use URL;

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
        if($hire->is_active == false) {
            abort(404);
        }
        else {
            if(!Session::has('url') || empty(Session::get('url'))) {
                Session::put('url', URL::previous());
            }
            return view('admin.hire.edit', [
                'vehicle' => $hire->vehicle,
                'hire' => $hire
            ]);
        }
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
            'hire' => 'Successfully updated hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$hire->vehicle->fullName(),
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);

        $url = Session::pull('url');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hire  $hire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hire $hire)
    {
        try {
            $$hire->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'hire' => 'Successfully deleted hire!',
            'ID = '.$hire->name,
            'Vehicle = '.$hire->vehicle->fullName(),
            'Start Date = '.date('j/M/Y', strtotime($hire->start_date)),
            'End Date = '.date('j/M/Y', strtotime($hire->end_date)),
        ]);

        return redirect()->back();
    }
}
