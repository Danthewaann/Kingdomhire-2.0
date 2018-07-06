@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
      @include('admin.vehicle.summary')
    </div>
    <div class="col-md-9 col-sm-8 col-xs-12">
      @if($gantt != null)
        <div class="panel panel-default">
          <div class="panel-heading"><h3>Reservations & Hires Gantt Chart</h3></div>
          <div class="panel-body" style="padding: unset">
            {!! $gantt !!}
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-md-5 col-sm-9 col-xs-12">
          @include('admin.vehicle.list-reservations')
        </div>
      </div>
    </div>
  </div>
@endsection