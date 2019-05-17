@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      @include('admin.common.alert')
      <!-- @include('admin.vehicle.create') -->
      <!-- <div class="col-lg-offset-6"> -->
        @include('admin.vehicle.lists.categories')
      <!-- </div> -->
    </div>
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
      @include('admin.vehicle.lists.admin')
    </div>
  </div>
@endsection
