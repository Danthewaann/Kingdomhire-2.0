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
        $vehicleType = VehicleType::create(array(
            'name' => $request->name,
        ));

        Session::flash('status', [
            'vehicle_gear_type_add' => 'Successfully created vehicle type '.$vehicleType->name
        ]);

        return redirect()->route('admin.home');
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
            'vehicle_gear_type' => 'Successfully updated vehicle type '.$vehicleType->name
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VehicleType $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicleType)
    {
        try {
            $vehicleType->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully deleted vehicle type '.$vehicleType->name
        ]);

        return redirect()->route('admin.home');
    }
}
