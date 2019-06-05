@extends('layouts.public')

@section('content')
@foreach($vehicleTypes as $vehicleType)
  @foreach($vehicleType->vehicles as $vehicle)
    @include('admin.vehicle.modals.image-gallery')
  @endforeach
@endforeach
<div class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="main-header">Our Fleet</h1>
      </div>
      <div class="col-md-6">
        <p class="paragraph">
          Below are all the vehicles that are in our fleet. Not all our vehicles may be be listed on our website,
          so it's best to call us to see what we have available.
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <img class="public-img" src="{{ asset('static/business.jpg') }}" width="100%">
        <h2 class="sub-header">Vehicle Rates/Hire Period</h2>
        <p class="paragraph">
          Our vehicle rates are competitive and can vary. They are also negotiable, so it's best to
          <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> to discuss pricing.
          Standard minimum renting period is <b>3 days</b> for all vehicles, large vans are an exception, where
          they start at <b>1 day</b> minimum rental.
        </p>
      </div>
      <div class="col-md-6">
        <img class="public-img" src="{{ asset('static/home-front-2.jpg') }}" width="100%">
        <h2 class="sub-header">Insurance Policy</h2>
        <p class="paragraph">
          Most of our vehicles come with insurance as standard.
          If you wish to use your own insurance, we are sure we are able to facilitate you.
        </p>
      </div>
    </div>
  </div>
</div>
<div class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      @include('admin.vehicle.lists.public')
    </div>
  </div>
</div>
@endsection
