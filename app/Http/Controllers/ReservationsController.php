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
        'made_by' => 'required|alpha',
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

    public function store(Request $request, $vehicle_id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $messages = array();
        if (DBQuery::doesDatesConflict($vehicle_id, $request->get('start_date'), $request->get('end_date'), $messages, null, true)) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($messages);
        }

        Reservation::create(array(
            'vehicle_id' => $vehicle_id,
            'made_by' => $request->made_by,
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date')
        ));

        return redirect()->route('vehicle.show', [
            'vehicle' => Vehicle::find($vehicle_id)
        ]);
    }


    public function cancel($id)
    {
        DB::table('reservations')
            ->where('id', '=', $id)
            ->delete();

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

    public function edit(Request $request, $vehicle_id, $reservation_id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $messages = array();
        if(DBQuery::doesDatesConflict($vehicle_id, $request->get('start_date'), $request->get('end_date'), $messages, $reservation_id, true)) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($messages);
        }

        DB::table('reservations')->where('id', '=', $reservation_id)->update([
            'made_by' => $request->made_by,
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('vehicle.show', [
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
