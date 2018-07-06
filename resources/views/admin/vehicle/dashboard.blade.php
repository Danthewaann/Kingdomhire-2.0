@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-md-2 col-sm-4 col-xs-12">
      @include('admin.vehicle.summary')
    </div>
    <div class="col-md-10 col-sm-4 col-xs-12">
      @include('admin.vehicle.navbar')
      <div class="row">
        <div class="col-md-4 col-sm-8 col-xs-12">
          @include('admin.vehicle.list-active-hire')
          @include('admin.vehicle.list-reservations')
        </div>
        @if($gantt != null)
          <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading"><h3>Reservations & Hires Gantt Chart</h3></div>
              <div class="panel-body" style="padding: unset">
                {!! $gantt !!}
              </div>
            </div>
          </div>
        @endif
        </div>
      </div>
    </div>
  </div>
@endsection