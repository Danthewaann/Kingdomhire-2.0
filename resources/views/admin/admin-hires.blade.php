@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Hires Dashboard</h1></div>
  </div>
  <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      @include('admin.hire.list-active')
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      @include('admin.hire.list-inactive')
    </div>
  </div>
@endsection