<?php

namespace App\Http\Controllers;

use App\VehicleRate;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class VehicleRatesController extends Controller
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
            'rates' => VehicleRate::all()
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

        VehicleRate::create(array(
            'name' => $request->get('name'),
            'weekly_rate_min' => $request->get('weekly_rate_min'),
            'weekly_rate_max' => $request->get('weekly_rate_max')
        ));
        return redirect()->route('admin.dashboard');
    }

    public function destroy($name)
    {
        DB::table('vehicle_rates')->where('name', '=', $name)->delete();
        return redirect()->back();
    }

    public function showAddForm()
    {
        return view('admin.vehicle-rate.add');
    }

    public function showEditForm($name)
    {
        return view('admin.vehicle-rate.edit', [
            'rate' => VehicleRate::whereName($name)->get()->first()
        ]);
    }

    public function edit(Request $request, $name)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        DB::table('vehicle_rates')
            ->where('name', '=', $name)
            ->update([
                'name' => $request->name,
                'weekly_rate_min' => $request->get('weekly_rate_min'),
                'weekly_rate_max' => $request->get('weekly_rate_max'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->route('admin.dashboard');
    }

}
