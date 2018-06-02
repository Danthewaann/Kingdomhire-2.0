@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    @include('admin.vehicle.summary')
    <div class="col-md-8 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="hires_per_month"></div>
        </div>
      </div>
      @barchart('Hires per month', 'hires_per_month')
    </div>
    <div class="col-md-4 col-xs-6">
      @include('admin.vehicle.list-inactive-hires')
    </div>
  </div>
@endsection