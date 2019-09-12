<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Http\Requests\ContactFormRequest;
use Session;
use Mail;
use Sitemap;

class PublicController extends Controller
{
    public function vehicles()
    {
        return view('public.vehicles', [
            'jsonVehicles' => Vehicle::withAll()->get()
        ]);
    }

    /**
     * Show the contact-us html page
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('public.contact');
    }

    /**
     * Show the home html page
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('public.home');
    }

    /**
     * Send a POST request to submit an email
     *
     * @param ContactFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postContactForm(ContactFormRequest $request)
    {
        $message = explode("\n", $request->get('message'));

        // Send email to kingdomhire
        Mail::send('email.contact-us', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'user_message' => $message
        ], function($message) use ($request) {
            $message->to('kingdomhire@googlemail.com')->subject('E-Mail Received');
        });

        // Send email receipt back to the initial sender
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

    /**
     * Show the sitemap, to allow web crawlers to index the site and its content.
     *
     * @return Sitemap
     */
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
                $tag->addImage(asset($image->image_uri), $vehicle->full_name);
            }
        }

        Sitemap::addTag(route('public.contact'), now(), null, '0.6');
        
        return Sitemap::render();
    }
}
