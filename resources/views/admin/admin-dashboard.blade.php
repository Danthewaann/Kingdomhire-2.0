@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="well">
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 style="margin-left: 5px">Administrator Dashboard</h2>
              </div>
              <div class="panel-body">
                <p>Welcome, {{ Auth::user()->name }}</p>
                @include('admin.common.alert')
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Reservations per vehicle</h3>
                <h5>{{ $reservations->count() }} reservation(s) in total</h5>
              </div>
              <div class="panel-body">
                <div id="vehicle_reservations"></div>
                @barchart('Vehicle Reservations', 'vehicle_reservations')
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Past hires</h3>
                <h5>{{ $pastHires->count() }} hire(s) in total</h5>
              </div>
              <div class="panel-body">
                <div id="overall_hires_per_month"></div>
                @columnchart('Overall Hires per month', 'overall_hires_per_month')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="well">
        @if($gantt != null)
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Active Hires</h3>
              <h5>{{ \App\Hire::whereIsActive(true)->get()->count() }} active hire(s) in total</h5>
            </div>
            {!! $gantt !!}
          </div>
        @endif
        <div class="row">
          <div class="col-md-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                @if($activeVehicles->isEmpty() and $inactiveVehicles->isEmpty())
                  <h3 style="text-align: center; margin-top: 0">No vehicles present</h3>
                @else
                  <h3 style="text-align: center; margin-top: 0">Vehicles</h3>
                  <h5 style="text-align: center">{{ $activeVehicles->count() + $inactiveVehicles->count() }} vehicle(s) in total</h5>
                @endif
              </div>
              <div class="panel-body">
                <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
                  @if($activeVehicles->isNotEmpty())
                    <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
                    @foreach(array_keys($activeVehicles->groupBy('type')->toArray()) as $key)
                      <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
                    @endforeach
                  @endif
                  @if($inactiveVehicles->isNotEmpty())
                    <li class="{{ $activeVehicles->isEmpty() ? 'active' : '' }}"><a data-toggle="pill" class="btn" href="#discontinued">Discontinued</a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-10 col-sm-12 col-xs-12">
            @include('admin.vehicle.list-admin')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
