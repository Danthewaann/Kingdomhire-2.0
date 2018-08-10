@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="col-lg-3 col-md-5 col-sm-5">
    @include('admin.vehicle.summary')
  </div>
  <div class="col-lg-9 col-md-7 col-sm-7">
    <div class="row">
      <div class="col-md-12">
      <nav class="navbar vehicle-dashboard-navbar-tabs">
        <ul class="nav nav-tabs nav-justified vehicle-dashboard-navbar-tabs" id="dashboard-navbar-tabs-collapse">
          <li class="{{ count($errors) == 0 ? 'active' : '' }}"><a data-toggle="tab" href="#info">Info</a></li>
          <li class="{{ count($errors) > 0 ? 'active' : '' }}"><a data-toggle="tab" href="#reservations">Reservations</a></li>
          <li><a data-toggle="tab" href="#hires">Hires</a></li>
          <li><a data-toggle="tab" href="#edit">Edit</a></li>
        </ul>
      </nav>
      <div class="container-fluid">
        <div class="row">
          <div class="tab-content vehicle-dashboard-tab-content">
            <div id="info" class="tab-pane fade{{ count($errors) == 0 ? ' in active' : '' }}">
              <div class="row">
                <div class="col-md-5">
                  @include('admin.vehicle.list-active-hire')
                  @include('admin.vehicle.list-next-reservation')
                </div>
                <div class="col-md-7">
                  <h3>Vehicle Statistics</h3>
                  <p style="font-size: 14px;">
                    <b>Overall total profit:</b> £{{ $vehicle->getTotalProfit() }} <br>
                    <b>Date added:</b> {{ $vehicle->created_at }} <br>
                    <b>Last changed:</b> {{ $vehicle->updated_at  }}
                  </p>
                  @if($gantt != null)
                    {!! $gantt !!}
                  @endif
                </div>
              </div>
            </div>
            <div id="reservations" class="tab-pane fade{{ count($errors) > 0 ? ' in active' : '' }}">
              <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                  @include('admin.reservation.add')
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                  @include('admin.vehicle.list-reservations')
                </div>
              </div>
            </div>
            <div id="hires" class="tab-pane fade">
              <div class="row">
                <div class="col-md-4">
                  @if($vehicle->getIncompleteHires()->isNotEmpty())
                    @include('admin.vehicle.list-incomplete-hires')
                  @endif
                  @include('admin.vehicle.list-inactive-hires')
                </div>
                @if($pastHires->isNotEmpty())
                  <div class="col-md-4">
                    <h3>Hires per month for {{ date('Y') }}</h3>
                    <div id="hires_per_month"></div>
                    @columnchart('Hires per month', 'hires_per_month')
                  </div>
                @endif
              </div>
            </div>
            <div id="edit" class="tab-pane fade">
              @include('admin.vehicle.edit')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection