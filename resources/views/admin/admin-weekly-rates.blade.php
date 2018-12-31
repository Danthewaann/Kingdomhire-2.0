@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      @include('admin.common.alert')
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>Weekly rates dashboard</h3>
        </div>
      </div>
      @include('admin.weekly-rate.create')
    </div>
    <div class="col-lg-3 col-md-8 col-sm-8 col-xs-12">
      @include('admin.weekly-rate.list')
    </div>
  </div>
@endsection