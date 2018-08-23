@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="well">
  <div class="row">
    <div class="col-md-5">
      @if(!empty(session()->get('status')['info']))
        @foreach(session()->get('status')['info'] as $message)
          <div class="alert alert-success">
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
          </div>
        @endforeach
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>Overall past hires</h3>
          <h5>{{ $pastHires->count() }} hire(s) in total</h5>
        </div>
        <div class="panel-body">
          <div id="overall_vehicle_hires_per_month"></div>
          @columnchart('Overall Hires per month', 'overall_vehicle_hires_per_month')
        </div>
      </div>
    </div>
    <div class="col-md-5">
      @if($vehicle->getIncompleteHires()->isNotEmpty())
        @include('admin.vehicle.list-incomplete-hires')
      @endif
      @include('admin.vehicle.list-inactive-hires')
    </div>
  </div>
</div>
@endsection