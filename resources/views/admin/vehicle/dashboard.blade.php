@extends('layouts.admin-main')

@section('content')
@include('admin.vehicle.modal-gallery')
<div class="container-fluid">
  <div class="col-lg-3 col-md-5 col-sm-5">
    @include('admin.vehicle.summary')
  </div>
  <div class="col-lg-9 col-md-7 col-sm-7">
    <div class="well">
      <div class="row">
        <div class="col-md-12">
        <nav class="navbar vehicle-dashboard-navbar-tabs">
          <ul class="nav nav-tabs nav-justified vehicle-dashboard-navbar-tabs" id="dashboard-navbar-tabs-collapse">
            <li class="{{ count($errors->getBags()) == 0 ? 'active' : '' }}"><a data-toggle="tab" href="#info_tab"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Info</a></li>
            <li class="{{ $errors->hasBag('reservations') ? 'active' : '' }}"><a data-toggle="tab" href="#reservations_tab"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Reservations</a></li>
            <li><a data-toggle="tab" id="hires_button" href="#hires_tab"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Hires</a></li>
            <li class="{{ $errors->hasBag('edit') ? 'active' : '' }}"><a data-toggle="tab" href="#edit_tab"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a></li>
          </ul>
        </nav>
        <div class="container-fluid">
          <div class="row">
            <div class="tab-content vehicle-dashboard-tab-content">
              <div id="info_tab" class="tab-pane fade{{ count($errors->getBags()) == 0 ? ' in active' : '' }}">
                <div class="row">
                  @if($vehicle->reservations->isNotEmpty() or $vehicle->hasActiveHire())
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
                  @else
                    <div class="col-md-5">
                      @include('admin.vehicle.list-active-hire')
                      @include('admin.vehicle.list-next-reservation')
                      <h3>Vehicle Statistics</h3>
                      <p style="font-size: 14px;">
                        <b>Overall total profit:</b> £{{ $vehicle->getTotalProfit() }} <br>
                        <b>Date added:</b> {{ $vehicle->created_at }} <br>
                        <b>Last changed:</b> {{ $vehicle->updated_at  }}
                      </p>
                    </div>
                  @endif
                </div>
              </div>
              <div id="reservations_tab" class="tab-pane fade{{ $errors->hasBag('reservations') ? ' in active' : '' }}">
                <div class="row">
                  @if($vehicle->reservations->isNotEmpty())
                    <div class="col-md-5 col-sm-12 col-xs-12">
                      @include('admin.vehicle.list-reservations')
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      @include('admin.reservation.add')
                    </div>
                  @else
                    <div class="col-md-4 col-sm-12 col-xs-12">
                      @include('admin.vehicle.list-reservations')
                      @include('admin.reservation.add')
                    </div>
                  @endif
                </div>
              </div>
              <div id="hires_tab" class="tab-pane fade">
                <div class="row">
                  <div class="col-md-5 col-sm-12 col-xs-12">
                    @if($vehicle->getIncompleteHires()->isNotEmpty())
                      @include('admin.vehicle.list-incomplete-hires')
                    @endif
                    @include('admin.vehicle.list-inactive-hires')
                  </div>
                  @if($pastHires->isNotEmpty())
                    <div class="col-md-7 col-sm-12 col-xs-12">
                      <h3>Hires per month for {{ date('Y') }}</h3>
                      {{--<div style="overflow-y: auto; height: 620px;">--}}
                        {{--<div id="overall_vehicle_hires_per_month"></div>--}}
                        {{--@columnchart('Overall Hires per month', 'overall_vehicle_hires_per_month')--}}
                      {{--</div>--}}
                      <div style="overflow-y: auto; height: 450px">
                        <div id="hires_per_month"></div>
                        @columnchart('Hires per month', 'hires_per_month')
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div id="edit_tab" class="tab-pane fade{{ $errors->hasBag('edit') ? ' in active' : '' }}">
                <div class="row">
                  @include('admin.vehicle.edit')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection