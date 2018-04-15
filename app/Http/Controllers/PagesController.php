<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function vehicles()
    {
        $vehicles = DB::table('vehicles')->where('is_active', '=', true)->get();
        return view('vehicles', ['vehicles' => $vehicles]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function home()
    {
        return view('home');
    }
}
