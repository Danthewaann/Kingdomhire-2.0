<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\WeeklyRate;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Session;

class WeeklyRatesController extends Controller
{
    private $store_rules = [
        'name' => 'required|unique:weekly_rates',
        'weekly_rate_min' => 'required|numeric|min:1|max:100',
        'weekly_rate_max' => 'required|numeric|min:2|max:200'
    ];

    private $edit_rules = [
        'name' => 'required',
        'weekly_rate_min' => 'required|numeric|min:1|max:100',
        'weekly_rate_max' => 'required|numeric|min:2|max:200'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.admin-vehicles-rates', [
            'rates' => WeeklyRate::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->store_rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $vehicle_rate = WeeklyRate::create(array(
            'name' => $request->get('name'),
            'weekly_rate_min' => $request->get('weekly_rate_min'),
            'weekly_rate_max' => $request->get('weekly_rate_max')
        ));

        Session::flash('status', [
            'weekly_rate_add' => 'Successfully created weekly rate '.$vehicle_rate->getFullName()
        ]);

        return redirect()->route('admin.home');
    }

    public function destroy(WeeklyRate $rate)
    {
        try {
            $rate->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'weekly_rate' => 'Successfully deleted weekly rate '.$rate->getFullName()
        ]);

        return redirect()->route('admin.home');
    }

    public function showAddForm()
    {
        return view('admin.vehicle-rate.add');
    }

    public function showEditForm($name)
    {
        return view('admin.vehicle-rate.edit', [
            'rate' => WeeklyRate::whereName($name)->first()
        ]);
    }

    public function edit(Request $request, WeeklyRate $rate)
    {
        $validator = Validator::make($request->all(), $this->edit_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $vehicles = Vehicle::whereWeeklyRate($rate->name)->get();
        try {
            $rate->delete();
        } catch (\Exception $e) {
        }

        $rate = new WeeklyRate([
            'name' => $request->name,
            'weekly_rate_min' => $request->weekly_rate_min,
            'weekly_rate_max' => $request->weekly_rate_max,
        ]);
        $rate->save();

        foreach ($vehicles as $vehicle) {
            $vehicle->weekly_rate = $rate->name;
            $vehicle->save();
        }

        Session::flash('status', [
            'weekly_rate' => 'Successfully updated weekly rate '.$rate->getFullName()
        ]);

        return redirect()->route('admin.home');
    }

}
