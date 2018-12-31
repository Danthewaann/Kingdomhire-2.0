@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
      @include('admin.common.alert')
      @include('admin.common.navbar')
    </div>
    <div class="col-lg-10 col-md-8 col-xs-12">
      <div class="row">
        @include('admin.hire.list-active')
        @include('admin.hire.list-inactive')
      </div>
    </div>
  </div>
@endsection