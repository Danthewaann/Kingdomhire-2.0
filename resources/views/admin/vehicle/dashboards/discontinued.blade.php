@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-12">
    @include('admin.vehicle.charts.yearly-hires-graph')
  </div>
  <div class="col-lg-6 col-md-10">
    @include('admin.vehicle.hires.show-inactive')
  </div>
</div>
@endsection