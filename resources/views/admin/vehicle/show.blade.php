@extends('layouts.app')

@section('content')
<div class="row">
  @foreach($vehicles as $vehicle)
    <div class="col-md-4">
      @include('admin.vehicle.list-public')
    </div>
  @endforeach
  <div class="col-md-4">
    @include('admin.reservation.list')
  </div>
  <div class="col-md-4">
    @include('admin.hire.list')
  </div>
</div>
@endsection