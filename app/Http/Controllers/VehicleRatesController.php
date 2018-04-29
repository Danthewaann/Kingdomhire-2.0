<?php

namespace App\Http\Controllers;

use App\DBQuery;
use App\VehicleRate;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;

class VehicleRatesController extends Controller
{
    private $rules = [
        'engine_size' => 'required',
        'weekly_rate_min' => 'required',
        'weekly_rate_max' => 'required'
    ];

    private $edit_rules = [
        'weekly_rate_min' => 'required',
        'weekly_rate_max' => 'required'
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        VehicleRate::create(array(
            'engine_size' => $request->get('engine_size'),
            'weekly_rate_min' => $request->get('weekly_rate_min'),
            'weekly_rate_max' => $request->get('weekly_rate_max')
        ));
        return redirect()->back();
    }

    public function destroy($engine_size)
    {
        DB::table('vehicle_rates')->where('engine_size', '=', $engine_size)->delete();
        return redirect()->back();
    }

    public function showEditForm($engine_size)
    {
        return view('admin.vehicle-rate.edit', [
            'rate' => DBQuery::getVehicleRate($engine_size)
        ]);
    }

    public function edit(Request $request, $engine_size)
    {
        $validator = Validator::make($request->all(), $this->edit_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        DB::table('vehicle_rates')
            ->where('engine_size', '=', $engine_size)
            ->update([
                'weekly_rate_min' => $request->get('weekly_rate_min'),
                'weekly_rate_max' => $request->get('weekly_rate_max'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->route('admin.dashboard');
    }

}
