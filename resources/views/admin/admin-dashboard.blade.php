@extends('layouts.admin-main')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="container-fluid">
  <div class="col-md-5 col-sm-5 col-xs-12">
    <h3>Reservations per vehicle</h3>
    <span>{{ count($reservations) }} reservation(s) in total</span>
    <div style="overflow-y: auto; height: {{ count($vehicles)*55+20 }}px">
      <div id="vehicle_reservations"></div>
      @barchart('Vehicle Reservations', 'vehicle_reservations')
    </div>
    <h3>Past hires</h3>
    <span>{{ count($pastHires) }} hire(s) in total</span>
    <div style="overflow-y: auto; height: 720px;">
      <div id="overall_hires_per_month"></div>
      @columnchart('Overall Hires per month', 'overall_hires_per_month')
    </div>
  </div>
  <div class="col-md-7 col-sm-7 col-xs-12">
    @include('admin.vehicle.list-admin')
  </div>
</div>
@endsection
