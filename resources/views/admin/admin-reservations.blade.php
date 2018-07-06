@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Reservations Dashboard</h1></div>
  </div>
  <div class="row">
    <div class="col-md-4 col-sm-9 col-xs-12">
      @include('admin.reservation.list')
    </div>
  </div>
@endsection