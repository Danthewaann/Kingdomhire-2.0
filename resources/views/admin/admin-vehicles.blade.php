@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Vehicles Dashboard</h1></div>
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
  <div class="col-md-6">
    @include('admin.vehicle.add')
  </div>
  <div class="col-md-6">
    @include('admin.vehicle-rate.add')
  </div>
@endsection