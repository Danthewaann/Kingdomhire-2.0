<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\VehicleImage;
use App\WeeklyRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Vehicle;
use Session;

class VehiclesController extends Controller
{
    private $store_rules = [
        'make' => 'required',
        'model' => 'required',
        'seats' => 'required|numeric|min:1|max:256',
        'vehicle_images' => 'array|nullable|image'
    ];

    private $edit_rules = [
        'vehicle_images_add' => 'nullable|array',
        'vehicle_images_del' => 'nullable|array'
    ];

    private $store_error_messages = [
        'make.required' => 'Vehicle make (manufacturer) is required',
        'model.required' => 'Vehicle model is required',
        'seats.required' => 'Number of seats is required',
        'vehicle_images.image' => 'Only image type files can be uploaded'
    ];

    private $edit_error_messages = [
        'vehicle_images_add.image' => 'Only image type files can be uploaded'
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
        $validator = Validator::make($request->all(), $this->store_rules, $this->store_error_messages);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $vehicle = Vehicle::create(array(
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'fuel_type' => $request->get('fuel_type'),
            'gear_type' => $request->get('gear_type'),
            'seats' => $request->get('seats'),
            'type' => $request->get('type'),
            'vehicle_rate_id' => WeeklyRate::whereName($request->get('rate_name'))->get()->first()->id
        ));

        if($request->hasFile('vehicle_images')) {
            $images = $request->file('vehicle_images');
            $i = 1;
            foreach ($images as $image) {
                $image_name = $request->get('make').'_'.
                    $request->get('model').'_'.$i.'.'.
                    $image->extension();

                $image_path = $image->storeAs('imgs/'.$request->get('make').'_'.
                    $request->get('model').'-'.$vehicle->id, $image_name, 'public');

                VehicleImage::create(array(
                    'name' => $image_name,
                    'image_uri' => asset('storage/' . $image_path),
                    'vehicle_id' => $vehicle->id
                ));

                $i++;
            }
        }

        Session::flash('status', [
            'vehicle' => 'Successfully created vehicle '.$vehicle->name()
        ]);

        return redirect()->route('admin.dashboard');
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

        Session::flash('status', [
            'vehicle' => 'Successfully discontinued vehicle '.Vehicle::find($id)->name()
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        try {
            $vehicle->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'vehicle' => 'Successfully deleted vehicle '.$vehicle->name()
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function showEditForm($id)
    {
        return view('admin.vehicle.edit', [
            'vehicle' => Vehicle::find($id),
            'rates' => WeeklyRate::all()
        ]);
    }

    public function showAddForm()
    {
        return view('admin.vehicle.add', [
          'rates' => WeeklyRate::all()
        ]);
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->edit_rules, $this->edit_error_messages);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator, 'edit');
        }

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

        if($request->rate_name != "") {
            DB::table('vehicles')
                ->where('id', '=', $id)->update([
                    'vehicle_rate_id' => WeeklyRate::whereName($request->get('rate_name'))->get()->first()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
        else {
            DB::table('vehicles')
                ->where('id', '=', $id)->update([
                    'vehicle_rate_id' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }

        Session::flash('status', [
            'edit' => 'Successfully edited '.$vehicle->name()
        ]);

        return redirect()->route('vehicle.show', [
            'vehicle' => $vehicle
        ]);
    }

    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        $pastHires = $vehicle->getInactiveHires()->SortBy('end_date');
        ChartGenerator::drawPastHiresBarChart($pastHires);
//        ChartGenerator::drawOverallPastHiresBarChart($pastHires);
        return view('admin.vehicle.dashboard', [
            'vehicle' => $vehicle,
            'gantt' => ChartGenerator::drawVehicleReservationsAndHiresGanttChart($vehicle),
            'rates' => WeeklyRate::all(),
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
