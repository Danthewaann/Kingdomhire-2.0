@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
      @include('admin.vehicle.navbar')
    </div>
      @if($gantt != null)
        <div class="col-md-12 col-xs-12">
          @include('admin.vehicle.gantt')
        </div>
      @endif
    <div class="col-md-3 col-sm-7 col-xs-12">
      @include('admin.vehicle.list-reservations')
    </div>
  </div>
@endsection