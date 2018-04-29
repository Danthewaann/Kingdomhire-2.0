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
        'end_date' => 'required|date'
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

    public function store(Request $request, $make, $model)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $vehicle_id = DB::table('vehicles')
            ->where([['make', '=', $make ], ['model', '=', $model]])
            ->pluck('id')
            ->first();

        if($request->get('start_date') == date('Y-m-d'))
        {
            Hire::create(array(
                'vehicle_id' => $vehicle_id,
                'start_date' =>  $request->get('start_date'),
                'end_date' =>  $request->get('end_date')
            ));

            DB::table('vehicles')
                ->where([['make', '=', $make], ['model', '=', $model]])
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
        return redirect()->route('vehicle.show', ['make' => $make, 'model' => $model]);
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

    public function showEditForm($make, $model, $id)
    {
        $reservation = DB::table('reservations')->where('id', '=', $id)->get()->first();
        return view('admin.reservation.edit', ['make' => $make, 'model' => $model, 'reservation' => $reservation]);
    }

    public function edit(Request $request, $make, $model, $id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        DB::table('reservations')->where('id', '=', $id)->update([
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date')
        ]);

        return redirect()->route('vehicle.show', ['make' => $make, 'model' => $model]);
    }

    public function all()
    {
        
    }
}
