@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-md-4 col-sm-12 col-xs-12">
    <div class="row">
      <div class="col-md-12">
        @include('admin.common.alert')
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2>Administrator Dashboard</h2>
          </div>
          <div class="panel-body">
            <h4>Welcome, {{ Auth::user()->name }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2>Reservations</h2>
            <h5>{{ $reservations->count() }} reservation(s) in total</h5>
          </div>
          <div class="panel-body">
            <div id="vehicle_reservations"></div>
            @barchart('Vehicle Reservations', 'vehicle_reservations')
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-6 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h2>Past hires</h2>
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
  <div class="col-md-8 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        @if($gantt == null)
          <div class="panel panel-default">
            <div class="panel-body">
              <h2>No active hires</h2>
            </div>
          </div>
        @else
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2>Active hires</h2>
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
@endsection
