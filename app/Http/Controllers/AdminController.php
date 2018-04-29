<?php

namespace App\Http\Controllers;

use App\Hire;
use App\Vehicle;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DBQuery;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin-dashboard', [
            'vehicles' => DBQuery::getActiveVehicles(),
            'reservations' => DBQuery::getReservations(),
            'hires' => DBQuery::getActiveHires(),
            'rates' => DBQuery::getVehicleRates()
        ]);
    }
}

