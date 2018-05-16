@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h1>Hires Dashboard</h1></div>
  </div>
  <div class="col-md-12">
    @include('admin.hire.list-all')
  </div>
@endsection