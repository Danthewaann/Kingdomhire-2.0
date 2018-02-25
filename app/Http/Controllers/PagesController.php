<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function vehicles()
    {
        return view('vehicles');
    }

    public function contact()
    {
        return view('contact');
    }
}
