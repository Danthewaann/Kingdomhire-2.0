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
      <div class="col-md-8">
        <h1 class="main-header">Our fleet</h1>
        <p class="paragraph">Below are all the vehicles in that are in our fleet. You need to call us to be able to reserve a vehicle.
          Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="row">
          <div class="col-md-12 col-sm-6">
            @include('public.opening-hours-table')
          </div>
          <div class="col-md-12 col-sm-6">
            @include('public.contact-table')
          </div>
        </div>
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
