@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
      @include('admin.vehicle.summary')
    </div>
    <div class="col-md-4 col-sm-5 col-xs-12">
      @include('admin.vehicle.list-active-hire')
      @include('admin.vehicle.list-reservations')
    </div>
  </div>
@endsection