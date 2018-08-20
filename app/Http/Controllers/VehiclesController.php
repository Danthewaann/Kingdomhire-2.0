<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Reservation;
use App\VehicleImage;
use App\WeeklyRate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        'vehicle_status' => 'nullable',
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
            'vehicle_rate_id' => WeeklyRate::whereName($request->get('rate_name'))->first()->id
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

        return redirect()->route('admin.home');
    }

    public function recontinue($id)
    {
        $vehicle = Vehicle::withTrashed()->where('id', $id)->first();
        $vehicle->status = 'Available';
        $vehicle->save();
        $vehicle->restore();

        Session::flash('status', [
            'info' => [
                're-continue' => 'Successfully re-continued '.$vehicle->name()
            ]
        ]);

        return redirect()->route('admin.vehicle.home', [
            'vehicle' => $vehicle
        ]);
    }

    public function discontinue($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->status = 'Unavailable';
        Reservation::destroy($vehicle->reservations->pluck('id')->toArray());
        if ($vehicle->hasActiveHire())  {
            $activeHire = $vehicle->getActiveHire();
            $activeHire->is_active = false;
            $activeHire->save();
        }

        $vehicle->save();
        $vehicle->delete();

        Session::flash('status', [
            'info' => [
                'discontinue' => 'Successfully discontinued '.$vehicle->name()
            ]
        ]);

        return redirect()->route('admin.vehicle.home', [
            'vehicle' => $vehicle
        ]);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::withTrashed()->where('id', $id)->first();
        $vehicle->forceDelete();

        Session::flash('status', [
            'vehicle' => 'Successfully deleted vehicle '.$vehicle->name()
        ]);

        return redirect()->route('admin.home');
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
            'rates' => WeeklyRate::all(),
            'types' => Vehicle::$types
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
        $vehicle->status = ($request->vehicle_status == null) ? $vehicle->status : $request->vehicle_status;
        $vehicle->weekly_rate_id = ($request->rate_name != "") ? WeeklyRate::whereName($request->get('rate_name'))->first()->id : null;
        $vehicle->save();

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

        Session::flash('status', [
            'edit' => 'Successfully edited '.$vehicle->name()
        ]);

        return redirect()->route('admin.vehicle.home', [
            'vehicle' => $vehicle
        ]);
    }

    public function show($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
        }
        catch (ModelNotFoundException $exception) {
            $vehicle = Vehicle::onlyTrashed()->where('id', $id)->first();
            if ($vehicle == null) {
                throw $exception;
            }
            else {
                $pastHires = $vehicle->getInactiveHires()->SortBy('end_date');
                ChartGenerator::drawOverallPastHiresBarChart($pastHires);
                return view('admin.vehicle.dashboard-discontinued', [
                    'vehicle' => $vehicle,
                    'pastHires' => $pastHires
                ]);
            }
        }

        $pastHires = $vehicle->getInactiveHires()->SortBy('end_date');
        ChartGenerator::drawPastHiresBarChart($pastHires);
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
