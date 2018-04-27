@extends('layouts.app')

@section('content')
<div class="row">
  @if(!empty($vehicles))
    @foreach($vehicles as $vehicle)
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-body">
            @include('admin.vehicle.list-public')
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="col-md-12">
      <div class="navbar">
        <div class="navbar-left">
          <h1>Vehicle Dashboard</h1>
          <a href="{{ route('reservation.form', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}"
             class="btn btn-primary" role="button" aria-pressed="true">Log Reservation</a>
          <a href="{{ route('vehicle.editForm', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}"
             class="btn btn-primary" role="button" aria-pressed="true">Edit</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-body">
          @include('admin.vehicle.list-public')
        </div>
      </div>
    </div>
  @endif
  <div class="col-md-4">
    @include('admin.reservation.list')
  </div>
  <div class="col-md-4">
    @include('admin.hire.list')
  </div>
</div>
@endsection