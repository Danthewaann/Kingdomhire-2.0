<?php

namespace App\Http\Controllers;

use App\Hire;
use App\Vehicle;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = DB::table('reservations')->get();
        $hires = DB::table('hires')->get();
        $vehicles = Vehicle::with(['reservations', 'hires', 'rate'])->get();
        return view('admin', ['vehicles' => $vehicles, 'reservations' => $reservations, 'hires' => $hires]);
    }

    public function addVehicle(Request $request)
    {
        $path = null;
        if($request->hasFile('vehicle_image')) {
            $image_name = $request->get('make') . '_' . $request->get('model') . '.' . $request->file('vehicle_image')->extension();
            $path = $request->file('vehicle_image')->storeAs('imgs', $image_name, 'public');
            $path = asset('storage/' . $path);
        }

        Vehicle::create(array(
           'make' => $request->get('make'),
           'model' => $request->get('model'),
           'fuel_type' => $request->get('fuel_type'),
           'gear_type' => $request->get('gear_type'),
           'seats' => $request->get('seats'),
           'status' => 'available',
           'type' => $request->get('type'),
           'image_path' => $path,
           'engine_size' => $request->get('engine_size')
        ));
        return redirect()->to('/admin');
    }

    public function deleteVehicle(Request $request)
    {
       $vehicle_arr = explode(' ', $request->get('delete'));
       DB::table('vehicles')->where([['make', '=', $vehicle_arr[0]], ['model', '=', $vehicle_arr[1]]])->update(['is_active' => false]);
       return redirect()->to('/admin');
    }

    public function logReservation(Request $request)
    {
        $vehicle_arr = explode(' ', $request->get('vehicle'));
        $collection = DB::table('vehicles')->where([['make', '=', $vehicle_arr[0]], ['model', '=', $vehicle_arr[1]]])->get(['id'])->toArray();
        Reservation::create(array(
           'vehicle_id' => $collection[0]->id,
            'is_active' => false
        ));
        return redirect()->to('/admin');
    }

    public function deleteReservation(Request $request)
    {
        DB::table('reservations')->where('id', '=', $request->get('reservation'))->delete();
        return redirect()->to('/admin');
    }

    public function logHire(Request $request)
    {
        $vehicle_arr = explode(' ', $request->get('vehicle'));
        $collection = DB::table('vehicles')->where([['make', '=', $vehicle_arr[0]], ['model', '=', $vehicle_arr[1]]])->get(['id'])->toArray();
        Hire::create(array(
            'vehicle_id' => $collection[0]->id,
            'is_active' => true
        ));
        return redirect()->to('/admin');
    }

    public function deleteHire(Request $request)
    {
        DB::table('hires')->where('id', '=', $request->get('hire'))->delete();
        return redirect()->to('/admin');
    }
}
