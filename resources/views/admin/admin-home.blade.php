@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-lg-12">
    @include('admin.common.alert')
    <!-- <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Admin dashboard</h3>
      </div>
      <div class="panel-body">
        <h4 style="text-align: center;">Welcome, {{ Auth::user()->name }}</h4>
      </div>
    </div> -->
  </div>
  <div class="col-lg-12">
    @include('admin.charts.active-hires')
  </div>
  <div class="col-lg-5 col-md-6 col-sm-7 col-xs-12">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            @include('admin.hire.list-active')  
          </div>
          <div class="col-md-12">
            @include('admin.reservation.list')
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-7 col-md-6 col-sm-5 col-xs-12">
    <div class="row">
      <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row"> -->
          <div class="col-lg-8 col-sm-12">
            @if($vehicles->isNotEmpty())
              @include('admin.reservation.create')
            @endif  
            @include('admin.charts.inactive-hires')
          </div>
          <div class="col-lg-4 col-sm-12">
          @include('admin.charts.yearly-hires-table')
            <!-- @include('admin.charts.inactive-hires') -->
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
        
      </div>
    <!-- </div>
  </div> -->
</div>
@endsection
