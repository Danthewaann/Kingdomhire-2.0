@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      @include('admin.common.alert')
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Vehicles dashboard</h3>
        </div>
      </div>
      @include('admin.vehicle.create')
      @include('admin.vehicle.lists.categories')
    </div>
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
      <div class="row">
        @include('admin.vehicle.lists.admin')
      </div>
    </div>
  </div>
@endsection
