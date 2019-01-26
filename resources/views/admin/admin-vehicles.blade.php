@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
      @include('admin.common.alert')
      @include('admin.vehicle.create')
      <div class="col-lg-offset-6">
        @include('admin.vehicle.lists.categories')
      </div>
    </div>
    <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
      @include('admin.vehicle.lists.admin')
    </div>
  </div>
@endsection
