<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $vehicles = DB::table('vehicles')->get();
        $reservations = DB::table('reservations')->get();
        dd($reservations);
//        $vehicle = \App\Reservation::find()->vehicle;
//        dd($vehicle->make);
//        $reservations_arr = array();
//        foreach ($reservations as $reservation) {
//            $vehicle = DB::table('vehicles')->where('id', '=', $reservation->vehicle_id)->get()->toArray();
//            array_push($reservations_arr, array(
//                'reservation_id' => $reservation->id,
//                'vehicle_name' => $vehicle[0]->make . ' ' . $vehicle[0]->model,
//                'start_date' => $reservation->start_date,
//                'end_date' => $reservation->end_date
//            ));
//        }
        return view('admin', ['vehicles' => $vehicles, 'reservations' => $reservations_arr]);
    }

    public function addVehicle(Request $request)
    {
        Vehicle::create(array(
           'make' => $request->get('make'),
           'model' => $request->get('model'),
           'fuel_type' => $request->get('fuel_type'),
           'gear_type' => $request->get('gear_type'),
           'seats' => $request->get('seats'),
           'status' => 'available',
           'type' => $request->get('type'),
           'image_path' => null,
           'engine_size' => $request->get('engine_size')
        ));
        return redirect()->to('/admin');
    }

    public function deleteVehicle(Request $request)
    {
       $vehicle_arr = explode(' ', $request->get('delete'));
       DB::table('vehicles')->where([['make', '=', $vehicle_arr[0]], ['model', '=', $vehicle_arr[1]]])->delete();
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
}
