<?php

namespace App\Http\Controllers;

use App\DBQuery;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Hire;

class HiresController extends Controller
{
    private $rules = [
        'start_date' => 'required|date_format:Y-m-d|before_or_equal:today',
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

    public function showEditForm($make, $model, $vehicle_id, $hire_id)
    {
        return view('admin.hire.edit', [
            'make' => $make,
            'model' => $model,
            'vehicle_id' => $vehicle_id,
            'hire' => Hire::find($hire_id)
        ]);
    }

    public function edit(Request $request, $make, $model, $vehicle_id, $hire_id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($validator);
        }

        $messages = array();
        if(DBQuery::doesDatesConflict($vehicle_id, $request->get('start_date'), $request->get('end_date'), $messages, $hire_id)) {
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($messages);
        }

        DB::table('hires')->where('id', '=', $hire_id)->update([
            'end_date' => $request->get('end_date'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('vehicle.show', [
            'make' => $make,
            'model' => $model,
            'vehicle_id' => $vehicle_id
        ]);
    }

    public function all()
    {
        return view('admin.admin-hires', [
            'hires' => Hire::all()
        ]);
    }
}
