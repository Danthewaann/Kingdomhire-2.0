<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Http\Requests\ReservationStoreRequest;
use App\Http\Requests\ReservationUpdateRequest;
use Session;
use URL;

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
     * @param ReservationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        $reservation = new Reservation($request->all());
        // If reservation failed to save (conflicts with another reservaton/hire), 
        // redirect back to use and flash error messages
        if (!$reservation->save() && $reservation->conflicts) {
            return back()->withInput()->withErrors($reservation->conflict_data, 'reservations');
        }

        $bookedMessage = $reservation->canConvertToHire() ? 'hire' : 'reservation';
        Session::flash('status', [
            'reservation' => 'Successfully booked ' . $bookedMessage . '!',
            'ID = '.$reservation->name,
            'Vehicle = '.$reservation->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($reservation->start_date)),
            'End Date = '.date('j/M/Y', strtotime($reservation->end_date)),
        ]);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        if(!Session::has('url') || empty(Session::get('url'))) {
            Session::put('url', URL::previous());
        }
        return view('admin.reservation.edit', [
            'vehicle' => $reservation->vehicle,
            'reservation' => $reservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ReservationUpdateRequest $request
     * @param  \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationUpdateRequest $request, Reservation $reservation)
    {
        // If reservation failed to update (conflicts with another reservaton/hire), 
        // redirect back to use and flash error messages
        if (!$reservation->update($request->all()) && $reservation->conflicts) {
            return back()->withInput()->withErrors($reservation->conflict_data, 'reservations');
        }

        $convertedMessage = $reservation->canConvertToHire() ? ' (converted to hire)' : '';
        Session::flash('status', [
            'reservation' => 'Successfully updated reservation!'.$convertedMessage,
            'ID = '.$reservation->name,
            'Vehicle = '.$reservation->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($reservation->start_date)),
            'End Date = '.date('j/M/Y', strtotime($reservation->end_date)),
        ]);

        return redirect()->to(Session::pull('url'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        Session::flash('status', [
            'reservation' => 'Successfully cancelled reservation!',
            'ID = '.$reservation->name,
            'Vehicle = '.$reservation->vehicle->full_name,
            'Start Date = '.date('j/M/Y', strtotime($reservation->start_date)),
            'End Date = '.date('j/M/Y', strtotime($reservation->end_date)),
        ]);
        
        return back();
    }
}
