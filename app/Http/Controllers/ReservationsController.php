<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Reservation;
use App\Hire;

class ReservationsController extends Controller
{
    private $rules = [
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'vehicle' => 'required'
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
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $vehicle_arr = explode(' ', $request->get('vehicle'));
        $vehicle_id = DB::table('vehicles')
            ->where([['make', '=', $vehicle_arr[0]], ['model', '=', $vehicle_arr[1]]])
            ->pluck('id')
            ->first();

        if($request->get('start_date') == date('Y-m-d'))
        {
            Hire::create(array(
                'vehicle_id' => $vehicle_id,
                'start_date' =>  $request->get('start_date'),
                'end_date' =>  $request->get('end_date')
            ));
        }
        else
        {
            Reservation::create(array(
                'vehicle_id' => $vehicle_id,
                'start_date' =>  $request->get('start_date'),
                'end_date' =>  $request->get('end_date')
            ));
        }
        return redirect()->route('vehicle.show', ['make' => $vehicle_arr[0], 'model' => $vehicle_arr[1]]);
    }

    public function cancel($id)
    {
        DB::table('reservations')->where('id', '=', $id)->delete();
        return redirect()->back();
    }

    public function showForm($make, $model)
    {
        return view('admin.reservation.add', ['make' => $make, 'model' => $model]);
    }
}
