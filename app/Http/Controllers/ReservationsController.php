<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Hire;
use App\Http\Requests\ReservationRequest;
use App\Vehicle;
use Session;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $vehicle = Vehicle::find($request->vehicle_id);
        if ($request->start_date == date('Y-m-d')) {
            Hire::create($request->all());
        }
        else {
            Reservation::create($request->all());
        }

        Session::flash('status', [
            'reservation' => 'Successfully booked reservation!'

        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        return view('admin.reservation.edit', [
            'vehicle' => $reservation->vehicle,
            'reservation' => $reservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReservationRequest $request
     * @param  \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        if ($reservation->hasStarted()) {
            Hire::create($request->all());
            try {
                $reservation->delete();
            } catch (\Exception $e) {
            }
        }
        else {
            $reservation->update($request->all());
        }

        Session::flash('status', [
            'reservation' => 'Successfully updated reservation!'
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $reservation->vehicle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'reservation' => 'Successfully canceled reservation!'
        ]);

        return redirect()->back();
    }
}
