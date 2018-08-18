<?php

namespace App\Http\Controllers;

use App\WeeklyRate;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Session;

class WeeklyRatesController extends Controller
{
    private $rules = [
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
        $validator = Validator::make($request->all(), $this->rules);

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

        return redirect()->route('admin.dashboard');
    }

    public function destroy($name)
    {
        $vehicle_rate = WeeklyRate::whereName($name)->get()->first();
        $vehicle_rate->delete();

        Session::flash('status', [
            'weekly_rate' => 'Successfully deleted weekly rate '.$vehicle_rate->getFullName()
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function showAddForm()
    {
        return view('admin.vehicle-rate.add');
    }

    public function showEditForm($name)
    {
        return view('admin.vehicle-rate.edit', [
            'rate' => WeeklyRate::whereName($name)->get()->first()
        ]);
    }

    public function edit(Request $request, $name)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $vehicle_rate = WeeklyRate::whereName($name)->get()->first();
        $vehicle_rate->update([
            'name' => $request->name,
            'weekly_rate_min' => $request->get('weekly_rate_min'),
            'weekly_rate_max' => $request->get('weekly_rate_max'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        Session::flash('status', [
            'weekly_rate' => 'Successfully updated weekly rate '.$vehicle_rate->getFullName()
        ]);

        return redirect()->route('admin.dashboard');
    }

}
