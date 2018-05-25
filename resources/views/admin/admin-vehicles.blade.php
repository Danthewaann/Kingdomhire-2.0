@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Vehicles Dashboard</h1></div>
    <div class="panel-body">
      <ul class="nav navbar-nav">
        <a href="{{ route('vehicle.add') }}" class="btn btn-primary" role="button" aria-pressed="true">Add A Vehicle</a>
        <a href="{{ route('vehicle-rate.index') }}" class="btn btn-primary" role="button" aria-pressed="true">Manage Vehicle Rates</a>
      </ul>
    </div>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>All Vehicles</h3></div>
      <div class="panel-body">
        @foreach($vehicles as $vehicle)
          @include('admin.vehicle.list-admin')
        @endforeach
      </div>
    </div>
  </div>
@endsection