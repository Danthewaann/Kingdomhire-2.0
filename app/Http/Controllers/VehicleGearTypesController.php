<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleGearTypeRequest;
use App\VehicleGearType;
use Session;

class VehicleGearTypesController extends Controller
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
        $vehicleGearTypes = VehicleGearType::with([
            'vehicles' => function ($vehicles) {
                $vehicles->withTrashed();
            }
        ])->get();

        return view('admin.admin-vehicle-gear-types', [
            'vehicleGearTypes' => $vehicleGearTypes,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicle-gear-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleGearTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleGearTypeRequest $request)
    {
        $vehicleGearType = VehicleGearType::create($request->all());

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully created gear type!',
            'Name = '.$vehicleGearType->name
        ]);

        return redirect()->route('admin.vehicle-gear-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VehicleGearType $vehicleGearType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleGearType $vehicleGearType)
    {
        return view('admin.vehicle-gear-type.edit', [
            'vehicleGearType' => $vehicleGearType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleGearTypeRequest $request
     * @param VehicleGearType $vehicleGearType
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleGearTypeRequest $request, VehicleGearType $vehicleGearType)
    {
        $vehicleGearType->update($request->all());

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully updated gear type!',
            'Name = '.$vehicleGearType->name
        ]);

        return redirect()->route('admin.vehicle-gear-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VehicleGearType $vehicleGearType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleGearType $vehicleGearType)
    {
        $vehicleGearType->delete();
        
        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully deleted gear type!',
            'Name = '.$vehicleGearType->name
        ]);

        return redirect()->route('admin.vehicle-gear-types.index');
    }
}
