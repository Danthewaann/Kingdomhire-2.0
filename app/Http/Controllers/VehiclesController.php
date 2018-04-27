<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Vehicle;
use App\DBQuery;

class VehiclesController extends Controller
{
    private $store_rules = [
        'make' => 'required',
        'model' => 'required',
        'seats' => 'required|numeric|min:1|max:256'
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
        $validator = Validator::make($request->all(), $this->store_rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $path = null;
        if($request->hasFile('vehicle_image')) {
            $image_name = $request->get('make').'_'.$request->get('model').'.'.$request->file('vehicle_image')->extension();
            $path = $request->file('vehicle_image')->storeAs('imgs', $image_name, 'public');
            $path = asset('storage/' . $path);
        }

        $vehicle_rate_id = DB::table('vehicle_rates')
            ->where('engine_size', '=', $request->get('engine_size'))
            ->get()->pluck('id')->first();

        Vehicle::create(array(
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'fuel_type' => $request->get('fuel_type'),
            'gear_type' => $request->get('gear_type'),
            'seats' => $request->get('seats'),
            'type' => $request->get('type'),
            'image_path' => $path,
            'vehicle_rate_id' => $vehicle_rate_id
        ));
        return redirect()->back();
    }

    public function discontinue($make, $model)
    {
        DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->update(['is_active' => false]);

        $vehicle_id = DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->get()->pluck('id')->first();

        DB::table('reservations')
            ->where('vehicle_id', '=', $vehicle_id)
            ->delete();

        return redirect()->route('admin.dashboard');
    }

    public function destroy($make, $model)
    {
        DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->delete();

        return redirect()->route('admin.dashboard');
    }

    public function showEditForm($make, $model)
    {
        $vehicle = Vehicle::with(['reservations', 'hires', 'rate'])
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->get()->first();

        return view('admin.vehicle.edit', ['vehicle' => $vehicle, 'rates' => DBQuery::getVehicleRates()]);
    }

    public function edit(Request $request, $make, $model)
    {
        $path = null;
        if($request->hasFile('vehicle_image')) {
            $image_name = $make.'_'.$model.'.'.$request->file('vehicle_image')->extension();
            $path = $request->file('vehicle_image')->storeAs('imgs', $image_name, 'public');
            $path = asset('storage/' . $path);
        }
        else {
            $path = DB::table('vehicles')
                ->where([['make', '=', $make], ['model', '=', $model]])
                ->get()->pluck('image_path')->first();
        }

        $vehicle_rate_id = DB::table('vehicle_rates')
            ->where('engine_size', '=', $request->get('engine_size'))
            ->get()->pluck('id')->first();

        DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->update(['vehicle_rate_id' => $vehicle_rate_id, 'image_path' => $path ]);

        return redirect()->route('admin.vehicle.show', ['make' => $make, 'model' => $model]);
    }

    public function show($make, $model)
    {
        $vehicle = Vehicle::with(['reservations', 'hires', 'rate'])
            ->where([['make', '=', $make], ['model', '=', $model]])
            ->get()->first();

        return view('admin.vehicle.show', ['vehicle' => $vehicle]);
    }
}
