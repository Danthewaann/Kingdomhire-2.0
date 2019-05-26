@extends('layouts.admin-vehicle-dashboard')

@section('content')
@if($gantt != null)
<div class="row">
  <div class="col-md-12 col-sm-12">
    @include('admin.vehicle.charts.schedule')
  </div>
</div>
@endif
<div class="row">
  <div class="col-lg-6 col-md-7 col-sm-12">
    @include('admin.vehicle.reservations.create')
    @include('admin.vehicle.hires.show-active')
    @include('admin.vehicle.reservations.show-all')
    @include('admin.vehicle.hires.show-inactive')
  </div>
  <div class="col-lg-6 col-md-5 col-sm-12">
    <div class="row">
      <div class="col-md-12">
        @include('admin.vehicle.charts.yearly-hires')
      </div>
      <div class="col-md-12">
      @include('admin.vehicle.charts.yearly-hires-graph')
      </div>
    </div>
  </div>
</div>
@endsection