@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="well">
        <div class="row">
          <div class="col-md-12">
            <h2>Administrator Dashboard</h2>
            <p>Welcome, {{ Auth::user()->name }}</p>
            @if(session()->has('status'))
              @foreach(session()->get('status') as $message)
                <div class="alert alert-success">
                  <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>
      <div class="well">
        <div class="row">
          <div class="col-md-12">
            <h3>Reservations per vehicle</h3>
            <h5>{{ $reservations->count() }} reservation(s) in total</h5>
            <div class="col-md-12">
              <div id="vehicle_reservations" class="row"></div>
              @barchart('Vehicle Reservations', 'vehicle_reservations')
            </div>
            @if($gantt != null)
              <div class="col-md-12">
                <div style="padding: 30px 0px 30px 0px">
                  {!! $gantt !!}
                </div>
              </div>
            @endif
            <h3>Past hires</h3>
            <h5>{{ $pastHires->count() }} hire(s) in total</h5>
            <div class="col-md-12">
              <div id="overall_hires_per_month" class="row"></div>
              @columnchart('Overall Hires per month', 'overall_hires_per_month')
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-sm-12 col-xs-12">
      @include('admin.vehicle.list-admin')
    </div>
  </div>
</div>
@endsection
