@extends('layouts.admin-main')

@section('content')
@include('admin.vehicle.navbar')
<div class="row">
  @include('admin.vehicle.summary')
  <div class="col-md-8 col-xs-12">
    @if($gantt != null)
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Reservations & Hires Gantt Chart</h3></div>
        <div class="panel-body">
          {!! $gantt !!}
        </div>
      </div>
    @else
      <div class="panel panel-default">
        <div class="panel-heading"><h3>No data to generate charts</h3></div>
      </div>
    @endif
  </div>
</div>
@endsection