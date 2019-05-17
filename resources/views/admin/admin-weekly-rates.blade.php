@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-4 col-sm-5 col-xs-12">
      @include('admin.common.alert')
      @include('admin.weekly-rate.create')
    </div>
    <div class="col-lg-4 col-sm-5 col-xs-12">
      @include('admin.weekly-rate.list')
    </div>
  </div>
@endsection