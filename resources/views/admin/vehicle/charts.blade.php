@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h3>Reservations & Hires Gantt Chart</h3></div>
        <div class="panel-body">
          {!! $gantt !!}
        </div>
      </div>
    </div>
  </div>
@endsection