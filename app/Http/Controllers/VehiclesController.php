<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Reservation;
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
        $activeVehicles = [];
        $vehiclesWithType = Vehicle::where('vehicle_type_id', '!=', null)->get();
        $vehiclesWithNoType = Vehicle::whereVehicleTypeId(null)->get();
        $inactiveVehicles = Vehicle::onlyTrashed()->get();
        $vehicleTypes = VehicleType::all();

        foreach ($vehiclesWithNoType as $vehicle) {
            array_push($activeVehicles, $vehicle);
        }

        foreach ($vehiclesWithType as $vehicle) {
            array_push($activeVehicles, $vehicle);
        }
        
        $activeVehicles = collect($activeVehicles);
        
        return view('admin.admin-vehicles', [
            'activeVehicles' => $activeVehicles,
            'vehiclesWithType' => $vehiclesWithType,
            'vehiclesWithNoType' => $vehiclesWithNoType,
            'vehicleTypes' => $vehicleTypes,
            'vehicleCount' => Vehicle::withTrashed()->count(),
            'inactiveVehicles' => $inactiveVehicles,
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
        $fuel_type_id = ($request->fuelType != "na") ? VehicleFuelType::whereName($request->fuelType)->first()->id : null;
        $gear_type_id = ($request->gearType != "na") ? VehicleGearType::whereName($request->gearType)->first()->id : null;
        $type_id = ($request->vehicleType != "na") ? VehicleType::whereName($request->vehicleType)->first()->id : null;
        $weekly_rate_id =  ($request->weeklyRate != "na") ? WeeklyRate::whereName($request->weeklyRate)->first()->id : null;

        $vehicle = Vehicle::create([
            'make' => $request->make,
            'model' => $request->model,
            'vehicle_fuel_type_id' => $fuel_type_id,
            'vehicle_gear_type_id' => $gear_type_id,
            'seats' => $request->seats,
            'status' => $request->status,
            'vehicle_type_id' => $type_id,
            'weekly_rate_id' => $weekly_rate_id
        ]);

        if($request->hasFile('vehicle_images_add')) {
            $images = $request->file('vehicle_images_add');
            $vehicle->linkImages($images, $request);
        }

        Session::flash('status', [
            'Successfully created vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->name(),
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
        $inactiveHires = $vehicle->getInactiveHires();
        ChartGenerator::drawOverallHiresBarChart($vehicle->hires, $height=350);

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
        $vehicle->status = ($request->status == null) ? $vehicle->status : $request->status;
        $vehicle->weekly_rate_id = ($request->weeklyRate != "na") ? WeeklyRate::whereName($request->weeklyRate)->first()->id : null;
        $vehicle->vehicle_type_id = ($request->vehicleType != "na") ? VehicleType::whereName($request->vehicleType)->first()->id : null;
        $vehicle->vehicle_fuel_type_id = ($request->fuelType != "na") ? VehicleFuelType::whereName($request->fuelType)->first()->id : null;
        $vehicle->vehicle_gear_type_id = ($request->gearType != "na") ? VehicleGearType::whereName($request->gearType)->first()->id : null;
        $vehicle->save();

        if($request->hasFile('vehicle_images_add')) {
            $images = $request->file('vehicle_images_add');
            $vehicle->linkImages($images, $request);
        }

        if($request->has('vehicle_images_del')) {
            $images = $request->get('vehicle_images_del');
            $vehicle->deleteImages($images);
        }

        $vehicle->updateImageOrder($request);

        Session::flash('status', [
            'edit' => 'Successfully updated vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->name(),
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
            'Name = '.$vehicle->name(),
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
        $vehicle->status = 'Unavailable';
        $vehicle->save();
        Reservation::destroy($vehicle->reservations->pluck('id')->toArray());
        if ($vehicle->hasActiveHire())  {
            $activeHire = $vehicle->getActiveHire();
            $activeHire->is_active = false;
            $activeHire->save();
        }

        try {
            $vehicle->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'discontinue' => 'Successfully discontinued vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->name(),
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
        $vehicle->status = 'Available';
        $vehicle->save();
        $vehicle->restore();

        Session::flash('status', [
            're-continue' => 'Successfully re-continued vehicle!',
            'ID = '.$vehicle->name,
            'Name = '.$vehicle->name(),
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }
}
