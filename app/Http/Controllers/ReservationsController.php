<?php

namespace App\Http\Controllers;

use App\DBQuery;
use App\Hire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Reservation;
use App\Vehicle;
use Session;
use App\Http\Requests\ReservationRequest;

class ReservationsController extends Controller
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

    public function store(ReservationRequest $request)
    {
        Session::flash('status', [
            'info' => [
                'reservation' => 'Successfully booked reservation!'
            ]
        ]);

        return redirect()->route('vehicle.show', [
            'vehicle' => Vehicle::find($request->vehicle_id)
        ]);
    }


    public function cancel($id)
    {
        Reservation::destroy($id);

        Session::flash('status', [
            'info' => [
                'reservation' => 'Successfully canceled reservation!'
            ]
        ]);

        return redirect()->back();
    }

    public function showForm($vehicle_id)
    {
        return view('admin.reservation.add', [
            'vehicle' => Vehicle::find($vehicle_id)
        ]);
    }

    public function showEditForm($vehicle_id, $reservation_id)
    {
        return view('admin.reservation.edit', [
            'vehicle' => Vehicle::find($vehicle_id),
            'reservation' => Reservation::find($reservation_id)
        ]);
    }

    public function edit(ReservationRequest $request)
    {
        Session::flash('status', [
            'info' => [
                'reservation' => 'Successfully edited reservation!'
            ]
        ]);

        return redirect()->route('vehicle.show', [
            'id' => $request->vehicle_id
        ]);
    }

    public function all()
    {
        return view('admin.admin-reservations', [
            'reservations' => Reservation::orderBy('end_date')->get()
        ]);
    }
}
