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
    <div style="overflow-y: auto; height: {{ count($vehicles)*50+20 }}px">
      <div id="vehicle_reservations"></div>
      @barchart('Vehicle Reservations', 'vehicle_reservations')
    </div>
    <h3>Overall Hires</h3>
    <span>{{ count($pastHires) }} hire(s) in total</span>
    <div style="overflow-y: auto; height: 620px;">
      <div id="overall_hires_per_month"></div>
      @columnchart('Overall Hires per month', 'overall_hires_per_month')
    </div>
      {{--@include('admin.vehicle.list')--}}
  </div>
  <div class="col-md-7 col-sm-7 col-xs-12">
    @include('admin.vehicle.list')
    {{--<h3>Overall Hires</h3>--}}
    {{--<span>{{ count($pastHires) }} hire(s) in total</span>--}}
    {{--<div style="overflow-y: auto; height: 620px;">--}}
      {{--<div id="overall_hires_per_month"></div>--}}
      {{--@columnchart('Overall Hires per month', 'overall_hires_per_month')--}}
    {{--</div>--}}
    {{--<h3>Hires per month for {{ date('Y') }}</h3>--}}
    {{--<div style="overflow-y: auto; min-height: 420px;">--}}
      {{--<div id="hires_per_month"></div>--}}
      {{--@columnchart('Hires per month', 'hires_per_month')--}}
    {{--</div>--}}
    {{--<h3>Reservations per vehicle</h3>--}}
    {{--<div style="overflow-y: auto; height: 450px">--}}
      {{--<div id="vehicle_reservations"></div>--}}
      {{--@barchart('Vehicle Reservations', 'vehicle_reservations')--}}
    {{--</div>--}}
  </div>
</div>
@endsection
