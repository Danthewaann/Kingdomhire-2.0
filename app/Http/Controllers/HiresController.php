<?php

namespace App\Http\Controllers;

use App\DBQuery;
use App\Http\Requests\HireRequest;
use App\Reservation;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
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

    public function showEditForm($vehicle_id, $hire_id)
    {
        $hire = Hire::find($hire_id);
        if($hire->is_active == true) {
            return view('admin.hire.edit', [
                'vehicle' => Vehicle::withTrashed()->where('id', $vehicle_id)->first(),
                'hire' => $hire
            ]);
        }
        else {
            return view('admin.hire.edit-past-hire', [
                'vehicle' => Vehicle::withTrashed()->where('id', $vehicle_id)->first(),
                'hire' => $hire
            ]);
        }
    }

    public function edit(HireRequest $request)
    {
        if(Hire::find($request->hire_id)->is_active == true) {
            Session::flash('status', [
                'hire' => 'Successfully edited active hire!'
            ]);
        }
        else {
            Session::flash('status', [
                'hire' => 'Successfully edited past hire!'
            ]);
        }

        return redirect()->route('admin.vehicle.home', [
            'vehicle_id' => $request->vehicle_id
        ]);
    }

    public function all()
    {
        return view('admin.admin-hires', [
            'vehicles' => Vehicle::all(),
            'activeHires' => Hire::whereIsActive(true)
                ->orderBy('start_date', 'desc')
                ->orderBy('end_date')
                ->get(),
            'inactiveHires' => Hire::whereIsActive(false)
                ->orderBy('start_date', 'desc')
                ->orderBy('end_date')
                ->get()
        ]);
    }
}
