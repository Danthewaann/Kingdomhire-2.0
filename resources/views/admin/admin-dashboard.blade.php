@extends('layouts.admin-main')

@section('content')
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Admin Dashboard</h1></div>
  </div>
  <div class="row">
    <div class="col-md-3 col-sm-5 col-xs-12">
      @include('admin.vehicle.list')
    </div>
    <div class="col-md-4 col-sm-7 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="vehicle_reservations"></div>
        </div>
      </div>
    </div>
    <div class="col-md-5 col-sm-7 col-xs-12">
      @barchart('Vehicle Reservations', 'vehicle_reservations')
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="hires_per_month"></div>
        </div>
      </div>
      @barchart('Hires per month', 'hires_per_month')
    </div>
  </div>
@endsection
