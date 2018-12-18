@extends('layouts.public')

@section('content')
@foreach($vehicles as $vehicle)
  @include('admin.vehicle.modals.image-gallery')
@endforeach
<div class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 style="margin-top: 10px">Our fleet</h1>
        <p style="text-align: justify">Below are all the vehicles in that are in our fleet. <br> You need to call us to be able to reserve a vehicle.
          <br>
          Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="row">
          <div class="col-md-12 col-sm-6" style="margin-top: 10px">
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
