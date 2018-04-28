<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Hire;

class HiresController extends Controller
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }

        $vehicle_arr = explode(' ', $request->get('vehicle'));
        $vehicle = DB::table('vehicles')
            ->where([['make', '=', $vehicle_arr[0]], ['model', '=', $vehicle_arr[1]]])
            ->get(['id'])
            ->toArray()[0];

        Hire::create(array(
            'vehicle_id' => $vehicle->id,
            'start_date' =>  $request->get('start_date'),
            'end_date' =>  $request->get('end_date')
        ));

        return redirect()->to('/admin');
    }

    public function all()
    {

    }
}
