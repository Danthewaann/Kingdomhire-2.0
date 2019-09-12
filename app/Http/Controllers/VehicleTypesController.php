<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleTypeRequest;
use App\VehicleType;
use Session;

class VehicleTypesController extends Controller
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
        $vehicleTypes = VehicleType::with([
            'vehicles' => function ($vehicles) {
                $vehicles->withTrashed();
            }
        ])->get();

        return view('admin.admin-vehicle-types', [
            'vehicleTypes' => $vehicleTypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicle-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleTypeRequest $request)
    {
        $vehicleType = VehicleType::create($request->all());

        Session::flash('status', [
            'vehicle_gear_type_add' => 'Successfully created vehicle type!',
            'Name = '.$vehicleType->name
        ]);

        return redirect()->route('admin.vehicle-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VehicleType $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleType $vehicleType)
    {
        return view('admin.vehicle-type.edit', [
            'vehicleType' => $vehicleType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleTypeRequest $request
     * @param VehicleType $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleTypeRequest $request, VehicleType $vehicleType)
    {
        $vehicleType->update($request->all());

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully updated vehicle type!',
            'Name = '.$vehicleType->name
        ]);

        return redirect()->route('admin.vehicle-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VehicleType $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicleType)
    {
        $vehicleType->delete();

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully deleted vehicle type!',
            'Name = '.$vehicleType->name
        ]);

        return redirect()->route('admin.vehicle-types.index');
    }
}
