<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Reservation;
use App\Hire;
use App\Http\Requests\ReservationRequest;
use App\Vehicle;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        $vehicles = Vehicle::all();
        ChartGenerator::drawReservationsBarChart($vehicles);

        return view('admin.admin-reservations', [
            'reservations' => $reservations,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        if ($request->start_date == date('Y-m-d')) {
            $reservation = Hire::create($request->all());
        }
        else {
            $reservation = Reservation::create($request->all());
        }

        Session::flash('status', [
            'reservation' => 'Successfully booked reservation!',
            'ID = '.$reservation->name,
            'Vehicle = '.$reservation->vehicle->fullName(),
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
     * @param ReservationRequest $request
     * @param  \App\Reservation $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        if ($request->start_date >= date('Y-m-d')) {
            Hire::create([
                'name' => $reservation->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'vehicle_id' => $reservation->vehicle->id
            ]);
            try {
                $reservation->delete();
            } catch (\Exception $e) {
            }
        }
        else {
            $reservation->update($request->all());
        }

        Session::flash('status', [
            'reservation' => 'Successfully updated reservation!',
            'ID = '.$reservation->name,
            'Vehicle = '.$reservation->vehicle->fullName(),
            'Start Date = '.date('j/M/Y', strtotime($reservation->start_date)),
            'End Date = '.date('j/M/Y', strtotime($reservation->end_date)),
        ]);

        $url = Session::pull('url');
        return redirect()->to($url);
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
            'reservation' => 'Successfully cancelled reservation!',
            'ID = '.$reservation->name,
            'Vehicle = '.$reservation->vehicle->fullName(),
            'Start Date = '.date('j/M/Y', strtotime($reservation->start_date)),
            'End Date = '.date('j/M/Y', strtotime($reservation->end_date)),
        ]);

        return redirect()->back();
    }
}
