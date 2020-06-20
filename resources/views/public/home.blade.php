@extends('layouts.public')

@section('content')
<section class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <figure class="col-sm-4">
        <img class="owner" src="{{ asset('static/owner.jpg') }}" alt="Proprietor - Keith Black">
        <figcaption class="caption">Proprietor - Keith Black</figcaption>		
      </figure>
      <header class="col-sm-8">
        <hr class="public-hr">
        <h1 class="main-header">Welcome to Kingdomhire</h1>
        <p class="paragraph">
          Kingdomhire is a one-man business owned and ran by proprietor <b>Keith Black</b>.
          The business specialises in vehicle hire and repair.
          Keith's experience spans over 40 years of working in the motor industry,
          so you can expect high quality service.
        </p>
        <p class="paragraph">
          Kingdomhire is based in <b>Northern Ireland</b>, located just outside <b>Markethill, Co. Armagh.</b> Exact directions can be found on our
          <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> page.
          Kingdomhire cater for general, public and business needs. Whatever you need, we are sure we can help you out.
        </p>
      </header>
    </div>
  </div>
</section>
<section class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      <article class="col-sm-6">
        <figure><img class="public-img" src="{{ asset('static/vehicles.jpg') }}" alt="Our fleet of vehicles"></figure>
        <header class="sub-header"><h2>Our Fleet of Vehicles</h2></header>
        <p class="paragraph">
          We have a wide selection of vehicles to choose from. We provide <b>Hatchbacks</b>, <b>People Carriers (MPVs)</b>, 
          <b>Small Vans</b>, <b>Large Vans</b>, <b>Convertibles</b> and more. Our fleet is ever expanding to include more vehicles, and we ensure that our vehicles are reliable and well maintained.
          You can check out what we have available on our <b><a class="text-link" href="{{ route('public.vehicles') }}">Vehicles</a></b> page.
        </p>
      </article>
      <article class="col-sm-6">
        <figure><img class="public-img" src="{{ asset('static/home-front.jpg') }}" alt="Kingdomhire location"></figure>
        <h2 class="sub-header">Vehicle Rates/Hire Period</h2>
        <p class="paragraph">
          Our vehicle rates are competitive and can vary from vehicle to vehicle. They are also negotiable, so it's best to
          <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> to discuss pricing.
          Standard minimum renting period is <b>3 days</b> for all vehicles, large vans are an exception, where
          they start at <b>1 day</b> minimum rental.
        </p>
      </article>
    </div>
    <div class="row">
      <article class="col-sm-6">
        <figure><img class="public-img" src="{{ asset('static/entrance.jpg') }}" alt="Kingdomhire main entrance"></figure>
        <header class="sub-header"><h2>Making a Reservation</h2></header>
        <p class="paragraph">
          You need to <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> to be able to reserve a vehicle.
          You should aim to reserve the vehicle you want to rent at least <b>1 day</b> before expected pickup.
          More information is available about making reservations on our
          <b><a class="text-link" href="{{ route('public.vehicles') }}">Vehicles</a></b> page.
        </p>
      </article>
      <article class="col-sm-6">
        <img class="public-img" src="{{ asset('static/business.jpg') }}" alt="Our facilities">
        <h2 class="sub-header">Insurance Policy</h2>
        <p class="paragraph">
          Most of our vehicles come with insurance as standard.
          If you wish to use your own insurance, we are sure we can facilitate you.
        </p>
      </article>
    </div>
  </div>
  </div>
</section>
@endsection
