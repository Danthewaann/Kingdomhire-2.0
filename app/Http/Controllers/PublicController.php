<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleImage;
use App\VehicleType;
use Illuminate\Http\Request;
use Validator;
use Session;
use Mail;
use Sitemap;
use App;

class PublicController extends Controller
{
    public function vehicles()
    {
        $activeVehicles = [];
        $vehicleTypes = VehicleType::whereHas('vehicles', function($query) {
            $query->where('status', '!=', 'Unavailable');
        })->get();
        $vehiclesWithType = Vehicle::where('vehicle_type_id', '!=', null)->where('status', '!=', 'Unavailable')->get();
        $vehiclesWithNoType = Vehicle::whereVehicleTypeId(null)->where('status', '!=', 'Unavailable')->get();

        foreach ($vehiclesWithNoType as $vehicle) {
            array_push($activeVehicles, $vehicle);
        }

        foreach ($vehiclesWithType as $vehicle) {
            array_push($activeVehicles, $vehicle);
        }
        
        $activeVehicles = collect($activeVehicles);

        return view('public.vehicles', [
            'activeVehicles' => $activeVehicles,
            'vehiclesWithType' => $vehiclesWithType,
            'vehiclesWithNoType' => $vehiclesWithNoType,
            'vehicleTypes' => $vehicleTypes,
            'vehicleCount' => Vehicle::count()
        ]);
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function home()
    {
        return view('public.home');
    }

    public function postContactForm(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => App::environment() === 'production' ? 'required' : 'nullable' . '|captcha'
        ];

        $messages = [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.'
        ];

        Validator::make($request->all(), $rules, $messages)->validate();

        Mail::send('email.contact-us', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_message' => nl2br($request->get('message'))
        ], function($message) use ($request) {
            $message->to('kingdomhire@googlemail.com')->subject('E-Mail Received');
        });

        Mail::send('email.receipt', [
            'subject' => $request->get('subject'),
            'user_message' => nl2br($request->get('message'))
        ], function($message) use ($request) {
            $message->to($request->get('email'))->subject('E-Mail Receipt | Kingdomhire');
        });

        Session::flash('status', [
            'E-Mail sent successfully!',
            'We\'ve sent an E-Mail receipt to ' . $request->get('email')
        ]);

        return back();
    }

    public function siteMap()
    {
        Sitemap::addTag(asset('static/Kingdomhire_logo.svg'), now(), null, null);
        Sitemap::addTag(asset('static/nav.jpg'), now(), null, null);
        
        $tag = Sitemap::addTag(route('public.root'), now(), null, '0.8');
        $tag->addImage(asset('static/owner.jpg'), 'Proprietor - Keith Black');
        $tag->addImage(asset('static/vehicles.jpg'), 'Our Fleet of Vehicles');
        $tag->addImage(asset('static/home-front.jpg'), 'Making a Reservation');

        $tag = Sitemap::addTag(route('public.home'), now(), null, '0.4');
        $tag->addImage(asset('static/owner.jpg'), 'Proprietor - Keith Black');
        $tag->addImage(asset('static/vehicles.jpg'), 'Our Fleet of Vehicles');
        $tag->addImage(asset('static/home-front.jpg'), 'Making a Reservation');

        $tag = Sitemap::addTag(route('public.vehicles'), now(), 'daily', '0.8');
        $tag->addImage(asset('static/business.jpg'), 'Vehicle Rates/Hire Period');
        $tag->addImage(asset('static/home-front-2.jpg'), 'Insurance Policy');

        foreach(Vehicle::all() as $vehicle) {
            foreach($vehicle->images as $image) {
                $tag->addImage($image->image_uri, $vehicle->name() . ' - ' . $image->name);
            }
        }

        Sitemap::addTag(route('public.contact'), now(), null, '0.6');
        
        return Sitemap::render();
    }
}
