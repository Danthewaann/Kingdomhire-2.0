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
        <p class="paragraph">Below are all the vehicles in that are in our fleet. You need to call us to be able to reserve a vehicle.
          Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
          <div class="alert alert-danger" style="margin-bottom: 0" role="alert">
            <span style="padding: 5px 0; font-size: 22px" class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;<strong style="font-size: 22px">Important note!</strong><br>
            The vehicles listed below may no longer be available.<br>
            Kingdomhire.com is currently being revamped, and soon all our vehicles will
            be listed on our site, so until then you can <a class="text-link" href="{{ route('public.contact')}}">contact us</a> to see what we have available.<br>
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
