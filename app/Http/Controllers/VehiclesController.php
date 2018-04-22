<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vehicle;

class VehiclesController extends Controller
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

    public function store(Request $request)
    {
        $path = null;
        if($request->hasFile('vehicle_image')) {
            $image_name = $request->get('make').'_'.$request->get('model').'.'.$request->file('vehicle_image')->extension();
            $path = $request->file('vehicle_image')->storeAs('imgs', $image_name, 'public');
            $path = asset('storage/' . $path);
        }

        $vehicle_rate_id = DB::table('vehicle_rates')
            ->where('engine_size', '=', $request->get('engine_size'))
            ->get()->pluck('id')[0];

        Vehicle::create(array(
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'fuel_type' => $request->get('fuel_type'),
            'gear_type' => $request->get('gear_type'),
            'seats' => $request->get('seats'),
            'type' => $request->get('type'),
            'image_path' => $path,
            'vehicle_rate_id' => $vehicle_rate_id
        ));
        return redirect()->to('/admin');
    }

    public function discontinue($make, $model)
    {
        DB::table('vehicles')->where([['make', '=', $make], ['model', '=', $model]])->update(['is_active' => false]);
        return redirect()->to('/admin');
    }

    public function destroy()
    {

    }

    public function show()
    {
        $vehicle = DB::table('vehicles')->where([['make', '=', $make], ['model', '=', $model]])->get();
        dd($vehicle);
    }
}
