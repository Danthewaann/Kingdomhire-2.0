@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="well">
  <div class="row">
    <div class="col-lg-4 col-md-12">
      @include('admin.common.alert')
      @include('admin.reservation.add')
      @include('admin.vehicle.list-active-hire')
      @include('admin.vehicle.list-reservations')
    </div>
    <div class="col-lg-8 col-md-12">
      @if($gantt != null)
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Schedule</h3>
                <h5>R = Reservation</h5>
                <h5>H = Active hire</h5>
              </div>
              {!! $gantt !!}
            </div>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-lg-6">
          @if($vehicle->getIncompleteHires()->isNotEmpty())
            @include('admin.vehicle.list-incomplete-hires')
          @endif
          @include('admin.vehicle.list-inactive-hires')
        </div>
        <div class="col-lg-6">
          @if($vehicle->getInactiveHires()->isNotEmpty())
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3>Yearly hires chart</h3>
                <h5>Shows hires per month per year</h5>
              </div>
              <div class="panel-body">
                <div id="overall_hires_per_month"></div>
                @columnchart('Overall Hires per month', 'overall_hires_per_month')
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection