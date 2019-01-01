@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    @include('admin.common.alert')
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Admin dashboard</h3>
      </div>
      <div class="panel-body">
        <h4>Welcome, {{ Auth::user()->name }}</h4>
      </div>
    </div>
    {{--<div class="panel panel-default">--}}
      {{--<div class="panel-body">--}}
        {{--<h4>Welcome {{ Auth::user()->name }}</h4>--}}
      {{--</div>--}}
    {{--</div>--}}
  </div>
  <div class="col-lg-9 col-md-8 col-xs-12">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        @include('admin.charts.active-hires')
      </div>
      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
        @include('admin.charts.reservations')
      </div>
      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
        @include('admin.charts.inactive-hires')
      </div>
    </div>
  </div>
</div>
@endsection
