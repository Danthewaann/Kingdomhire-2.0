@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      @include('admin.common.alert')
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Reservations dashboard</h3>
        </div>
      </div>
      @include('admin.reservation.create')
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      @include('admin.reservation.list')
    </div>
    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
      @include('admin.charts.reservations')
    </div>
  </div>
@endsection