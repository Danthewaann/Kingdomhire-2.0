@extends('layouts.admin-vehicle-dashboard')

@section('content')
<nav class="navbar navbar-default navbar-static-top vehicle-dashboard-navbar-tabs">
  <ul class="nav navbar-default nav-tabs nav-justified vehicle-dashboard-navbar-tabs" id="dashboard-navbar-tabs-collapse">
    <li class="{{ count($errors) == 0 ? 'active' : '' }}"><a data-toggle="tab" href="#info">Info</a></li>
    <li><a data-toggle="tab" href="#schedule">Schedule</a></li>
    <li class="{{ count($errors) > 0 ? 'active' : '' }}"><a data-toggle="tab" href="#reservations">Reservations</a></li>
    <li><a data-toggle="tab" href="#hires">Hires</a></li>
    <li><a data-toggle="tab" href="#edit">Edit</a></li>
  </ul>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="tab-content vehicle-dashboard-tab-content">
      <div id="info" class="tab-pane fade{{ count($errors) == 0 ? ' in active' : '' }}">
        <div class="col-md-5">
          <div class="row">
            @include('admin.vehicle.list-active-hire')
            @include('admin.vehicle.list-reservations')
          </div>
        </div>
      </div>
      <div id="schedule" class="tab-pane fade">
        <div class="col-md-12">
          <div class="row">
          @if($gantt != null)
            @include('admin.vehicle.gantt')
          @endif
          </div>
        </div>
      </div>
      <div id="reservations" class="tab-pane fade{{ count($errors) > 0 ? ' in active' : '' }}">
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="row">
            @include('admin.reservation.add')
          </div>
        </div>
      </div>
      <div id="hires" class="tab-pane fade">
        @if($pastHires->isNotEmpty())
          <div id="hires_per_month"></div>
          @columnchart('Hires per month', 'hires_per_month')
        @endif
      </div>
      <div id="edit" class="tab-pane fade">
        @include('admin.vehicle.edit')
      </div>
    </div>
  </div>
</div>
@endsection