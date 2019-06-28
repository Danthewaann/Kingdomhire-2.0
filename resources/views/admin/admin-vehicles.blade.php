@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      @include('admin.common.alert-success')
    </div>
    @include('admin.vehicle.lists.admin')
  </div>
@endsection
