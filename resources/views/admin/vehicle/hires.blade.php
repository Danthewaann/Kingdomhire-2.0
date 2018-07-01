@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
      @include('admin.vehicle.list-active-hire')
      @include('admin.vehicle.summary')
    </div>
    <div class="col-md-6 col-sm-4 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="hires_per_month"></div>
        </div>
      </div>
      @barchart('Hires per month', 'hires_per_month')
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
      @include('admin.vehicle.list-inactive-hires')
    </div>
  </div>
@endsection