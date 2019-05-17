@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      @include('admin.common.alert')
      @include('admin.vehicle-fuel-type.create')
    </div>
    <div class="col-lg-4 col-md-8 col-sm-6 col-xs-12">
      @include('admin.vehicle-fuel-type.list')
    </div>
  </div>
@endsection