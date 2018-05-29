@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    @include('admin.vehicle.summary')
    <div class="col-md-6 col-xs-12">
      @include('admin.vehicle.list-active-hire')
      @include('admin.vehicle.list-inactive-hires')
    </div>
  </div>
@endsection