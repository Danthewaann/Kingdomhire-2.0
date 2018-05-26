<?php

namespace App\Http\Controllers;

use App\DBQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Reservation;
use App\Vehicle;

class ReservationsController extends Controller
{
    private $rules = [
        'start_date' => 'required|date_format:Y-m-d|after_or_equal:today',
        'end_date' => 'required|date_format:Y-m-d|after:start_date'
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

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $messages = array();
        $reservations = Reservation::whereVehicleId($vehicle_id)->get();
        $activeHire = Vehicle::find($vehicle_id)->getActiveHire();
        if (DBQuery::doesReservationConflict($request->get('start_date'), $request->get('end_date'), $reservations, $messages, $activeHire)) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($messages);
        }

        Reservation::create(array(
            'vehicle_id' => $vehicle_id,
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date')
        ));

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
            'reservation' => Reservation::find($reservation_id)
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

        $messages = array();
        $reservations = Reservation::all()
            ->where('vehicle_id', '=', $vehicle_id)
            ->reject(function($reservation) use ($reservation_id) {
                return $reservation->id == $reservation_id;
            });

        $activeHire = Vehicle::find($vehicle_id)->getActiveHire();
        if(DBQuery::doesReservationConflict($request->get('start_date'), $request->get('end_date'), $reservations, $messages, $activeHire)) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($messages);
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
            'reservations' => Reservation::orderBy('end_date')->get()
        ]);
    }
}
