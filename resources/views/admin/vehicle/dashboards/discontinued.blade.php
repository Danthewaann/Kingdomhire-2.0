@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="row">
  <div class="col-md-5">
    @include('admin.vehicle.charts.yearly-hires-graph')
  </div>
  <div class="col-md-5">
    @include('admin.vehicle.hires.show-inactive')
  </div>
</div>
@endsection