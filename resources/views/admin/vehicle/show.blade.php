@extends('layouts.admin-main')

@section('content')
<div class="row">
  @if(!empty($vehicles))
    @foreach($vehicles as $vehicle)
      <div class="col-md-4 col-xs-4">
        <div class="panel panel-default">
          <div class="panel-body">
            @include('admin.vehicle.list-public')
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h1>{{ $vehicle->name() }} Dashboard</h1></div>
        <div class="panel-body">
          <ul class="nav navbar-nav">
            <a href="{{ route('reservation.form', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}"
               class="btn btn-primary" role="button" aria-pressed="true">Log Reservation</a>
            <a href="{{ route('vehicle.editForm', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}"
               class="btn btn-primary" role="button" aria-pressed="true">Edit</a>
            {{ Form::open(['route' => ['vehicle.discontinue', $vehicle->make, $vehicle->model, $vehicle->id], 'style' => 'display: inline-block;', 'method' => 'delete']) }}
            {{ Form::submit('Discontinue', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}
            {{ Form::open(['route' => ['vehicle.delete', $vehicle->make, $vehicle->model, $vehicle->id], 'style' => 'display: inline-block;', 'method' => 'delete']) }}
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
    </div>
  @endif
  <div class="col-md-5 col-xs-6">
    @include('admin.vehicle.list-reservations')
  </div>
  <div class="col-md-5 col-xs-6">
    @include('admin.vehicle.list-active-hire')
  </div>
    <div class="col-md-5 col-xs-6">
      @include('admin.vehicle.list-inactive-hires')
    </div>
</div>
@endsection