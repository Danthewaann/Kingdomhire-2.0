@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-md-4 col-sm-8 col-xs-12">
      @include('admin.vehicle-rate.list')
    </div>
  </div>
@endsection