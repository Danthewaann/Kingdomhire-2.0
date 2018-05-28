@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h1>{{ $vehicle->name() }} Dashboard</h1></div>
      <div class="panel-body">
        <ul class="nav navbar-nav" style="padding: 10px;">
          <a href="{{ route('reservation.form', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Log Reservation</a>
          <a href="{{ route('vehicle.editForm', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Edit</a>
          <a href="{{ route('vehicle.charts', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Charts</a>
          {{ Form::open(['route' => ['vehicle.discontinue', $vehicle->id], 'style' => 'display: inline-block; margin: 1px;', 'method' => 'delete']) }}
          {{ Form::submit('Discontinue', ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
          {{ Form::open(['route' => ['vehicle.delete', $vehicle->id], 'style' => 'display: inline-block; margin: 1px;', 'method' => 'delete']) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-4 col-xs-6">
    <div class="panel panel-default">
      <div class="panel-body">
        @include('admin.vehicle.list-public')
      </div>
    </div>
    @include('admin.vehicle.list-inactive-hires')
  </div>
  <div class="col-md-5 col-xs-6">
    @include('admin.vehicle.list-reservations')
    @include('admin.vehicle.list-active-hire')
  </div>
</div>
@endsection