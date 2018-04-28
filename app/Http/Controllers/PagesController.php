<?php

namespace App\Http\Controllers;

use App\DBQuery;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function vehicles()
    {
        return view('public.vehicles', ['vehicles' => DBQuery::getActiveVehicles()]);
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function home()
    {
        return view('public.home');
    }
}
