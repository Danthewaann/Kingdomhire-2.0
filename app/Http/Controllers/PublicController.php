<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\VehicleImage;
use App\VehicleType;
use App\VehicleFuelType;
use App\VehicleGearType;
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
        $jsonVehicles = Vehicle::with('images')->get();
        $jsonVehicles->transform(function($i) {
            $fuel_type = VehicleFuelType::find($i->vehicle_fuel_type_id);
            $gear_type = VehicleGearType::find($i->vehicle_gear_type_id);
            $type = VehicleType::find($i->vehicle_type_id);

            $i->fuel_type = $fuel_type != null ? $fuel_type->name : '';
            $i->gear_type = $gear_type != null ? $gear_type->name : '';
            $i->type = $type != null ? $type->name : '';
            $i->seats = $i->seats . ' seats';
            $i->name = $i->make . ' ' . $i->model;
            unset(
                $i->vehicle_fuel_type_id, $i->vehicle_gear_type_id, $i->vehicle_type_id,
                $i->id, $i->created_at, $i->updated_at, $i->deleted_at,
                $i->status, $i->weekly_rate_id
            );

            foreach ($i->images as $image) {
                unset(
                    $image->id, $image->order, $image->created_at, $image->updated_at,
                    $image->vehicle_id
                );
            }

            return $i;
        });

        return view('public.vehicles', [
            'jsonVehicles' => $jsonVehicles,
            'vehicleCount' => $jsonVehicles->count()
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

        $message = explode("\n", $request->get('message'));

        Mail::send('email.contact-us', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_message' => $message
        ], function($message) use ($request) {
            $message->to('kingdomhire@googlemail.com')->subject('E-Mail Received');
        });

        Mail::send('email.receipt', [
            'subject' => $request->get('subject'),
            'user_message' => $message
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
        $tag->addImage(asset('static/entrance.jpg'), 'Vehicle Rates/Hire Period');
        $tag->addImage(asset('static/business.jpg'), 'Insurance Policy');

        foreach(Vehicle::all() as $vehicle) {
            foreach($vehicle->images as $image) {
                $tag->addImage(asset($image->image_uri), $vehicle->name() . ' - ' . $image->name);
            }
        }

        Sitemap::addTag(route('public.contact'), now(), null, '0.6');
        
        return Sitemap::render();
    }
}
