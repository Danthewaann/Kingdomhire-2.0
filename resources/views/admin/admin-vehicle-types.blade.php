@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      @include('admin.common.alert')
    </div>
    <div class="col-lg-4 col-sm-7 col-xs-12">
      @include('admin.vehicle-type.create')
    </div>
    <div class="col-lg-4 col-sm-5 col-xs-12">
      @include('admin.vehicle-type.list')
    </div>
  </div>
@endsection