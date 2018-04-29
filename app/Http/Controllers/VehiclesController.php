<?php

namespace App\Http\Controllers;

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

        Vehicle::create(array(
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'fuel_type' => $request->get('fuel_type'),
            'gear_type' => $request->get('gear_type'),
            'seats' => $request->get('seats'),
            'type' => $request->get('type'),
            'image_path' => $path,
            'vehicle_rate_id' =>  DBQuery::getVehicleRate($request->get('engine_size'))->id
        ));

        return redirect()->back();
    }

    public function discontinue($make, $model, $id)
    {
        DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model], ['id', '=', $id]])
            ->update(['is_active' => false, 'status' => 'Unavailable']);

        $vehicle_id = DBQuery::getVehicle($make, $model, $id)->id;

        DB::table('reservations')
            ->where('vehicle_id', '=', $vehicle_id)
            ->delete();

        DB::table('hires')
            ->where('vehicle_id', '=', $vehicle_id)
            ->update(['is_active' => false]);

        return redirect()->route('admin.dashboard');
    }

    public function destroy($make, $model, $id)
    {
        DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model], ['id', '=', $id]])
            ->delete();

        return redirect()->route('admin.dashboard');
    }

    public function showEditForm($make, $model, $id)
    {
        return view('admin.vehicle.edit', [
            'vehicle' => DBQuery::getVehicle($make, $model, $id),
            'rates' => DBQuery::getVehicleRates()
        ]);
    }

    public function edit(Request $request, $make, $model, $id)
    {
        $path = null;
        if($request->hasFile('vehicle_image')) {
            $image_name = $make.'_'.$model.'.'.$request->file('vehicle_image')->extension();
            $path = $request->file('vehicle_image')->storeAs('imgs', $image_name, 'public');
            $path = asset('storage/' . $path);
        }
        else {
            $path = DBQuery::getVehicle($make, $model, $id)->pluck('image_path');
        }

        DB::table('vehicles')
            ->where([['make', '=', $make], ['model', '=', $model], ['id', '=', $id]])
            ->update([
                'vehicle_rate_id' => DBQuery::getVehicleRate($request->get('engine_size'))->id,
                'image_path' => $path,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->route('vehicle.show', [
            'make' => $make,
            'model' => $model,
            'vehicle_id' => $id
        ]);
    }

    public function show($make, $model, $id)
    {
        return view('admin.vehicle.show', [
            'vehicle' => DBQuery::getVehicle($make, $model, $id)
        ]);
    }

    public function all()
    {
        return view('admin.admin-vehicles', [
            'rates' => DBQuery::getVehicleRates(),
            'vehicles' => DBQuery::getAllVehicles()
        ]);
    }
}
