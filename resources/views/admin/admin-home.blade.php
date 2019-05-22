@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-lg-12">
    @include('admin.common.alert')
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
          <div class="col-md-12">
            @include('admin.hire.list-inactive')
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-7 col-md-6 col-sm-5 col-xs-12">
    <div class="row">
      <div class="col-lg-8 col-sm-12">
        @if($vehicles->isNotEmpty())
          @include('admin.reservation.create')
        @endif  
        @include('admin.charts.inactive-hires')
      </div>
      <div class="col-lg-4 col-sm-12">
      @include('admin.charts.yearly-hires-table')
      </div>
    </div>
  </div>
</div>
@endsection
