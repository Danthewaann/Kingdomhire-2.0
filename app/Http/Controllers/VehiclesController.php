<?php

namespace App\Http\Controllers;

use App\DataVisualisation\ChartGenerator;
use App\WeeklyRate;
use App\VehicleType;
use App\VehicleGearType;
use App\VehicleFuelType;
use App\Vehicle;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use Session;

class VehiclesController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-vehicles', [
            'jsonVehicles' => Vehicle::withTrashed()->withAll()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicle.create', [
            'weeklyRates' => WeeklyRate::all(),
            'vehicleTypes' => VehicleType::all(),
            'fuelTypes' => VehicleFuelType::all(),
            'gearTypes' => VehicleGearType::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleStoreRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        // Link uploaded images with vehicle if there is any 
        if ($request->hasFile('vehicle_images_add')) {
            $images = $request->file('vehicle_images_add');
            $vehicle->linkImages($images, $request);
        }

        Session::flash('status', [
            'Successfully created vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->make_model,
        ]);

        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        Session::forget('url');
        $inactiveHires = $vehicle->inactive_hires;
        ChartGenerator::drawOverallHiresBarChart($vehicle->hires, 350);

        // Show specific dashboard for discontinued vehicles
        if ($vehicle->trashed()) {
            return view('admin.vehicle.dashboards.discontinued', [
                'vehicle' => $vehicle,
                'inactiveHires' => $inactiveHires
            ]);
        }
        else {
            return view('admin.vehicle.dashboards.active', [
                'vehicle' => $vehicle,
                'inactiveHires' => $inactiveHires,
                'gantt' => ChartGenerator::drawVehicleReservationsAndHiresGanttChart($vehicle),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicle.edit', [
            'vehicle' => $vehicle,
            'weeklyRates' => WeeklyRate::all(),
            'vehicleTypes' => VehicleType::all(),
            'fuelTypes' => VehicleFuelType::all(),
            'gearTypes' => VehicleGearType::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleUpdateRequest $request
     * @param  \App\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        // Link uploaded images with vehicle if there is any 
        if($request->hasFile('vehicle_images_add')) {
            $images = $request->file('vehicle_images_add');
            $vehicle->linkImages($images, $request);
        }

        // Delete images linked with vehicle if any are provided
        if($request->has('vehicle_images_del')) {
            $images = $request->get('vehicle_images_del');
            $vehicle->deleteImages($images);
        }

        // Update the order of images for display in vehicle image galleries
        $vehicle->updateImageOrder($request);

        Session::flash('status', [
            'edit' => 'Successfully updated vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->make_model,
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->forceDelete();

        Session::flash('status', [
            'Successfully deleted vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->make_model,
        ]);

        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Soft delete the specified resource
     *
     * @param \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function discontinue(Vehicle $vehicle)
    {
        $vehicle->delete();

        Session::flash('status', [
            'discontinue' => 'Successfully discontinued vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->make_model,
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Restore the specified resource
     *
     * @param \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function recontinue(Vehicle $vehicle)
    {
        $vehicle->restore();

        Session::flash('status', [
            're-continue' => 'Successfully re-continued vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->make_model,
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }
}
