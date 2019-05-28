@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      @include('admin.common.alert-success')
    </div>
    <div class="col-lg-5 col-sm-7 col-xs-12">
      @include('admin.weekly-rate.create')
    </div>
    <div class="col-lg-4 col-sm-5 col-xs-12">
      @include('admin.weekly-rate.list')
    </div>
  </div>
@endsection