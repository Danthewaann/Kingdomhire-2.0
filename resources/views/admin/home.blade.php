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
          <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Reservations per vehicle</h3>
                <h5>{{ $reservations->count() }} reservation(s) in total</h5>
              </div>
              <div class="panel-body">
                {{--<div class="scrollable-chart">--}}
                  <div id="vehicle_reservations"></div>
                  @barchart('Vehicle Reservations', 'vehicle_reservations')
                {{--</div>--}}
              </div>
            </div>
          </div>
          <div class="col-md-12 col-sm-6 col-xs-12">
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
    <div class="col-md-8 col-xs-12">
      <div class="well">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            @if($gantt == null)
              <div class="panel panel-default">
                <div class="panel-body">
                  <h3>No active hires</h3>
                </div>
              </div>
            @else
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3>Active hires</h3>
                  <h5>{{ \App\Hire::whereIsActive(true)->get()->count() }} active hire(s) in total</h5>
                </div>
                {!! $gantt !!}
              </div>
            @endif
          </div>
          @include('admin.vehicle.lists.admin')
        </div>
      </div>
    </div>
  </div>
@endsection
