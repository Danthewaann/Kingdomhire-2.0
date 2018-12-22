<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleFuelTypeRequest;
use App\VehicleFuelType;
use Session;

class VehicleFuelTypesController extends Controller
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
        return view('admin.vehicle-fuel-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleFuelTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleFuelTypeRequest $request)
    {
        $vehicleFuelType = VehicleFuelType::create(array(
            'name' => $request->name,
        ));

        Session::flash('status', [
            'vehicle_fuel_type_add' => 'Successfully created fuel type '.$vehicleFuelType->name
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VehicleFuelType $vehicleFuelType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleFuelType $vehicleFuelType)
    {
        return view('admin.vehicle-fuel-type.edit', [
            'vehicleFuelType' => $vehicleFuelType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleFuelTypeRequest $request
     * @param VehicleFuelType $vehicleFuelType
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleFuelTypeRequest $request, VehicleFuelType $vehicleFuelType)
    {
        $vehicleFuelType->update($request->all());

        Session::flash('status', [
            'weekly_rate' => 'Successfully updated fuel type '.$vehicleFuelType->name
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VehicleFuelType $vehicleFuelType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleFuelType $vehicleFuelType)
    {
        try {
            $vehicleFuelType->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'vehicle_fuel_type' => 'Successfully deleted fuel type '.$vehicleFuelType->name
        ]);

        return redirect()->route('admin.home');
    }
}
