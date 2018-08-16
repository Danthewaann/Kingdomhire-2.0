@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
    <div class="col-md-5 col-sm-12 col-xs-12">
      <div class="well">
        <div class="row">
          <div class="col-md-12">
            @if(session()->has('status'))
              @foreach(session()->get('status') as $message)
                <div class="alert alert-success" style="margin-top: 22px">
                  <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
                </div>
              @endforeach
            @endif
            <h3>Reservations per vehicle</h3>
            <h5>{{ count($reservations) }} reservation(s) in total</h5>
            <div class="row">
              <div class="scrollable-list" style="height: {{ count($vehicles)*55+20 }}px">
                <div id="vehicle_reservations" class="col-md-12"></div>
                @barchart('Vehicle Reservations', 'vehicle_reservations')
              </div>
            </div>
            @if($gantt != null)
            <div style="padding: 30px 30px 30px 0px">
              {!! $gantt !!}
            </div>
            @endif
            <h3>Past hires</h3>
            <h5>{{ count($pastHires) }} hire(s) in total</h5>
            <div class="row">
              <div class="scrollable-list" style="height: {{ $maxAmountOfHiresPerMonth > 5 ? $maxAmountOfHiresPerMonth*30+20 : 420 }}px">
                <div id="overall_hires_per_month" class="col-md-12"></div>
                @columnchart('Overall Hires per month', 'overall_hires_per_month')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 col-sm-12 col-xs-12">
        @include('admin.vehicle.list-admin')
    </div>
</div>
@endsection
