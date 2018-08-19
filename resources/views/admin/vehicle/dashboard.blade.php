@extends('layouts.admin-main')

@section('content')
@include('admin.vehicle.modal-gallery')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-3 col-md-5 col-sm-5">
      <div class="well">
        <h2 style="text-align: center">Vehicle Dashboard</h2>
        <h4 style="text-align: center">{{ $vehicle->name() }}</h4>
      </div>
      @include('admin.vehicle.dashboard-summary')
    </div>
    <div class="col-lg-9 col-md-7 col-sm-7">
      <div class="well">
        <div class="row">
          <div class="col-md-12">
            <nav class="navbar vehicle-dashboard-navbar-tabs">
              <ul class="nav nav-tabs nav-justified vehicle-dashboard-navbar-tabs" id="dashboard-navbar-tabs-collapse">
                <li class="{{ (count($errors->getBags()) == 0 and (empty(session()->get('status')) or !empty(session()->get('status')['info']))) ? 'active' : '' }}">
                  <a data-toggle="tab" class="btn" href="#info_tab"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;Info</a>
                </li>
                <li class="{{ $errors->hasBag('reservations') ? 'active' : '' }}">
                  <a data-toggle="tab" class="btn" href="#reservations_tab"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Book Reservation</a>
                </li>
                <li class="{{ !empty(session()->get('status')['hires']) ? 'active' : '' }}">
                  <a data-toggle="tab" class="btn" id="hires_button" href="#hires_tab"><span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Past Hires</a>
                </li>
                <li class="{{ ($errors->hasBag('edit') or !empty(session()->get('status')['edit'])) ? 'active' : '' }}">
                  <a data-toggle="tab" class="btn" href="#edit_tab"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </li>
              </ul>
            </nav>
            <div class="container-fluid">
              <div class="row">
                <div class="tab-content vehicle-dashboard-tab-content">
                  <div id="info_tab" class="tab-pane fade{{ (count($errors->getBags()) == 0 and (empty(session()->get('status')) or !empty(session()->get('status')['info']))) ? ' in active' : '' }}">
                    <div class="row">
                      @if($vehicle->reservations->isNotEmpty() or $vehicle->hasActiveHire())
                        <div class="col-md-5">
                          @if(!empty(session()->get('status')['info']))
                            @foreach(session()->get('status')['info'] as $message)
                              {{--@dd($message)--}}
                              <div class="alert alert-success" style="margin-top: 22px">
                                <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
                              </div>
                            @endforeach
                          @endif
                          {{--@if(!empty(session()->get('status')['info']))--}}
                            {{--@if(!empty(session()->get('status')['info']['hire']))--}}
                              {{--<div class="alert alert-success" id="" style="margin-top: 22px">--}}
                                {{--<span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ session('status')['info'] }}--}}
                              {{--</div>--}}
                            {{--@endif--}}
                            {{--@if(!empty(session()->get('status')['info']['reservation']))--}}
                              {{--<div class="alert alert-success" id="" style="margin-top: 22px">--}}
                                {{--<span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ session('status')['info']['reservation'] }}--}}
                              {{--</div>--}}
                            {{--@endif--}}
                          {{--@endif--}}
                          @include('admin.vehicle.list-active-hire')
                          @include('admin.vehicle.list-reservations')
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
                          {{--<h3>Hires per month</h3>--}}
                          {{--<div style="overflow-y: auto; height: 620px;">--}}
                          {{--<div class="col-md-12">--}}
                            {{--<div id="overall_vehicle_hires_per_month" class="row"></div>--}}
                            {{--@columnchart('Overall Hires per month', 'overall_vehicle_hires_per_month')--}}
                          {{--</div>--}}
                        </div>
                      @else
                        <div class="col-md-5">
                          @if(!empty(session()->get('status')['info']))
                            @foreach(session()->get('status')['info'] as $message)
                              {{--@dd($message)--}}
                              <div class="alert alert-success" style="margin-top: 22px">
                                <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
                              </div>
                            @endforeach
                          @endif
                          @include('admin.vehicle.list-active-hire')
                          @include('admin.vehicle.list-reservations')
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
                      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        @include('admin.reservation.add')
                      </div>
                    </div>
                  </div>
                  <div id="hires_tab" class="tab-pane fade{{ !empty(session()->get('status')['hires']) ? ' in active' : '' }}">
                    <div class="row">
                      <div class="col-md-5 col-sm-12 col-xs-12">
                        @if(!empty(session()->get('status')['hires']))
                          @foreach(session()->get('status')['hires'] as $message)
                            <div class="alert alert-success" style="margin-top: 22px">
                              <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
                            </div>
                          @endforeach
                        @endif
                        @if($vehicle->getIncompleteHires()->isNotEmpty())
                          @include('admin.vehicle.list-incomplete-hires')
                        @endif
                        @include('admin.vehicle.list-inactive-hires')
                      </div>
                      @if($pastHires->isNotEmpty())
                        <div class="col-md-7 col-sm-12 col-xs-12">
                          {{--<h3>Hires per month</h3>--}}
                          {{--<div style="overflow-y: auto; height: 620px;">--}}
                          {{--<div class="col-md-12">--}}
                            {{--<div id="overall_vehicle_hires_per_month" class="row"></div>--}}
                            {{--@columnchart('Overall Hires per month', 'overall_vehicle_hires_per_month')--}}
                          {{--</div>--}}
                          {{--</div>--}}
                          <h3>Hires per month for {{ date('Y') }}</h3>
                          <div style="overflow-y: auto; height: 450px">
                          {{--<div class="col-md-12">--}}
                            <div id="hires_per_month"></div>
                            @columnchart('Hires per month', 'hires_per_month')
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div id="edit_tab" class="tab-pane fade{{ ($errors->hasBag('edit') or !empty(session()->get('status')['edit'])) ? ' in active' : '' }}">
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
</div>
@endsection