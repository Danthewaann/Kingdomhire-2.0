@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Reservations Dashboard</h1></div>
  </div>
  <div class="row">
    <div class="col-md-12">
      @include('admin.reservation.list')
    </div>
  </div>
@endsection