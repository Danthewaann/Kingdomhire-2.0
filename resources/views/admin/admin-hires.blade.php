@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
      @include('admin.common.alert')
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Hires dashboard</h3>
        </div>
      </div>
      @include('admin.hire.list-active')
      @include('admin.hire.list-inactive')
    </div>
    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
      @include('admin.charts.active-hires')
      @include('admin.charts.inactive-hires')
    </div>
  </div>
@endsection