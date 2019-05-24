@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="row">
  @if($gantt != null)
    <div class="col-md-12 col-sm-12">
      @include('admin.vehicle.charts.schedule')
    </div>
  @endif
  <div class="col-lg-6 col-md-12 col-sm-12">
    @include('admin.vehicle.hires.show-active')
    @include('admin.vehicle.reservations.show-all')
    @include('admin.vehicle.hires.show-inactive')
  </div>
  <div class="col-lg-6 col-md-12 col-sm-12">
    @include('admin.vehicle.reservations.create')
    <div class="row">
      <div class="col-lg-12">
        @include('admin.vehicle.charts.yearly-hires-graph')
        @include('admin.vehicle.charts.yearly-hires')
      </div>
    </div>
  </div>
</div>
@endsection