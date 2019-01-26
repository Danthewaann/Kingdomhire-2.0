@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      @include('admin.common.alert')
      @include('admin.vehicle-type.create')
    </div>
    <div class="col-lg-3 col-md-8 col-sm-6 col-xs-12">
      @include('admin.vehicle-type.list')
    </div>
  </div>
@endsection