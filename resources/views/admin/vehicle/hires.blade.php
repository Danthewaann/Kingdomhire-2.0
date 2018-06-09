@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    @include('admin.vehicle.summary')
    <div class="col-md-8 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="hires_per_month"></div>
        </div>
      </div>
      @barchart('Hires per month', 'hires_per_month')
    </div>
    <div class="col-md-5 col-xs-7">
      @include('admin.vehicle.list-active-hire')
    </div>
    <div class="col-md-3 col-xs-5">
      @include('admin.vehicle.list-inactive-hires')
    </div>
  </div>
@endsection