<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\VehicleImage;
use App\VehicleRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Vehicle;

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
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $vehicle_id = Vehicle::create(array(
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'fuel_type' => $request->get('fuel_type'),
            'gear_type' => $request->get('gear_type'),
            'seats' => $request->get('seats'),
            'type' => $request->get('type'),
            'vehicle_rate_id' => VehicleRate::whereEngineSize($request->get('engine_size'))->get()->first()->id
        ))->id;

        if($request->hasFile('vehicle_images')) {
            $images = $request->file('vehicle_images');
            $i = 1;
            foreach ($images as $image) {
                $image_name = $request->get('make').'_'.
                    $request->get('model').'_'.$i.'.'.
                    $image->extension();

                $image_path = $image->storeAs('imgs/'.$request->get('make').'_'.
                    $request->get('model').'-'.$vehicle_id, $image_name, 'public');

                VehicleImage::create(array(
                    'name' => $image_name,
                    'image_uri' => asset('storage/' . $image_path),
                    'vehicle_id' => $vehicle_id
                ));

                $i++;
            }
        }

        return redirect()->route('admin.vehicles');
    }

    public function discontinue($id)
    {
        DB::table('vehicles')
            ->where('id', '=', $id)
            ->update(['is_active' => false, 'status' => 'Unavailable']);

        DB::table('reservations')
            ->where('vehicle_id', '=', $id)
            ->delete();

        DB::table('hires')
            ->where('vehicle_id', '=', $id)
            ->update(['is_active' => false]);

        return redirect()->route('admin.vehicles');
    }

    public function destroy($id)
    {
        DB::table('vehicles')
            ->where('id', '=', $id)
            ->delete();

        return redirect()->route('admin.vehicles');
    }

    public function showEditForm($id)
    {
        return view('admin.vehicle.edit', [
            'vehicle' => Vehicle::find($id),
            'rates' => VehicleRate::all()
        ]);
    }

    public function showAddForm()
    {
        return view('admin.vehicle.add', [
          'rates' => VehicleRate::all()
        ]);
    }

    public function edit(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);
        if($request->hasFile('vehicle_images_add')) {
            $images = $request->file('vehicle_images_add');
            $i = count(VehicleImage::whereVehicleId($id)->get());
            foreach ($images as $image) {
                $i++;
                $image_name = $vehicle->make.'_'.$vehicle->model.'_'.$i.'.'.$image->extension();
                $image_path = $image->storeAs('imgs/'.$vehicle->make.'_'.$vehicle->model, $image_name, 'public');

                VehicleImage::create(array(
                    'name' => $image_name,
                    'image_uri' => asset('storage/' . $image_path),
                    'vehicle_id' => $id
                ));
            }
        }

        if($request->has('vehicle_images_del')) {
            $images = $request->get('vehicle_images_del');
            foreach ($images as $image) {
                DB::table('vehicle_images')->where('name', '=', $image)->delete();
            }
        }

        DB::table('vehicles')
            ->where('id', '=', $id)->update([
                'vehicle_rate_id' => VehicleRate::whereEngineSize($request->get('engine_size'))->get()->first()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->route('vehicle.show', [
            'vehicle' => $vehicle
        ]);
    }

    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        $pastHires = $vehicle->getInactiveHires();
        ChartGenerator::drawPastHiresBarChart($pastHires);
        return view('admin.vehicle.dashboard', [
            'vehicle' => $vehicle,
            'gantt' => ChartGenerator::drawVehicleReservationsAndHiresGanttChart($vehicle),
            'rates' => VehicleRate::all(),
            'pastHires' => $pastHires
        ]);
    }

    public function showHires($id)
    {
        $vehicle = Vehicle::find($id);
        $pastHires = $vehicle->getInactiveHires();
        ChartGenerator::drawPastHiresBarChart($pastHires);

        return view('admin.vehicle.hires', [
            'vehicle' => $vehicle,
            'pastHires' => $pastHires
        ]);
    }

    public function showReservations($id)
    {
        $vehicle = Vehicle::find($id);
        return view('admin.vehicle.reservations', [
            'vehicle' => $vehicle,
            'gantt' => ChartGenerator::drawVehicleReservationsAndHiresGanttChart($vehicle)
        ]);
    }

    public function all()
    {
        return view('admin.admin-vehicles', [
            'vehicles' => Vehicle::all()
        ]);
    }
}
