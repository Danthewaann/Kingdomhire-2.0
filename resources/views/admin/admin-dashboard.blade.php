@extends('layouts.admin-main')

@section('content')
  @if (session('status'))
      <div class="alert alert-success">
          {{ session('status') }}
      </div>
  @endif
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Admin Dashboard</h1></div>
    <div class="panel-body" style="padding: unset">
      <ul class="nav navbar-nav" style="padding: 10px;">
        <a href="{{ route('vehicle.add') }}" class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Add A Vehicle</a>
        <a href="{{ route('vehicle-rate.index') }}" class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Manage Vehicle Rates</a>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2 col-sm-5 col-xs-12">
      @include('admin.vehicle.list')
    </div>
    <div class="col-md-6 col-sm-7 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Hires per month for {{ date('Y') }}</h3>
        </div>
        <div class="panel-body" style="padding: unset">
          <div id="hires_per_month"></div>
          @columnchart('Hires per month', 'hires_per_month')
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Number of reservations per vehicle</h3>
        </div>
        <div class="panel-body" style="padding: unset">
          <div id="vehicle_reservations"></div>
          @barchart('Vehicle Reservations', 'vehicle_reservations')
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-7 col-xs-12">
      @include('admin.hire.list-active')
      @include('admin.reservation.list')
    </div>
  </div>
@endsection
