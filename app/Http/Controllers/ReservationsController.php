<?php

namespace App\Http\Controllers;

use App\DBQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Reservation;
use App\Vehicle;
use App\Hire;

class ReservationsController extends Controller
{
    private $rules = [
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date'
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

    public function store(Request $request, $make, $model, $vehicle_id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        if($request->get('start_date') == date('Y-m-d'))
        {
            Hire::create(array(
                'vehicle_id' => $vehicle_id,
                'start_date' =>  $request->get('start_date'),
                'end_date' =>  $request->get('end_date')
            ));

            DB::table('vehicles')
                ->where([['make', '=', $make], ['model', '=', $model] , ['id', '=', $vehicle_id]])
                ->update(['status' => 'Out for hire']);
        }
        else
        {
            Reservation::create(array(
                'vehicle_id' => $vehicle_id,
                'start_date' =>  $request->get('start_date'),
                'end_date' =>  $request->get('end_date')
            ));
        }

        return redirect()->route('vehicle.show', [
            'make' => $make,
            'model' => $model,
            'id' => $vehicle_id
        ]);
    }

    public function cancel($id)
    {
        DB::table('reservations')
            ->where('id', '=', $id)
            ->delete();

        return redirect()->back();
    }

    public function showForm($make, $model, $vehicle_id)
    {
        return view('admin.reservation.add', [
            'make' => $make,
            'model' => $model,
            'id' => $vehicle_id
        ]);
    }

    public function showEditForm($make, $model, $vehicle_id, $reservation_id)
    {
        return view('admin.reservation.edit', [
            'make' => $make,
            'model' => $model,
            'vehicle_id' => $vehicle_id,
            'reservation' => DBQuery::getReservation($reservation_id)
        ]);
    }

    public function edit(Request $request, $make, $model, $vehicle_id, $reservation_id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        DB::table('reservations')->where('id', '=', $reservation_id)->update([
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('vehicle.show', [
            'make' => $make,
            'model' => $model,
            'id' => $vehicle_id
        ]);
    }

    public function all()
    {
        return view('admin.admin-reservations', [
            'reservations' => DBQuery::getReservations()
        ]);
    }
}
