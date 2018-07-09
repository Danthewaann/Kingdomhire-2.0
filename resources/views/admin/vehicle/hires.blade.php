@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
    @include('admin.vehicle.navbar')
    <div class="row">
      @if($pastHires->isNotEmpty())
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div class="panel panel-default">
            <div class="panel-heading panel-title-text"><h3>Hires per month for {{ date('Y') }}</h3></div>
            <div class="panel-body" style="padding: unset">
              <div id="hires_per_month"></div>
            </div>
          </div>
          @columnchart('Hires per month', 'hires_per_month')
        </div>
      @endif
      <div class="col-md-5">
        {{--@include('admin.vehicle.list-active-hire')--}}
        {{--@include('admin.vehicle.list-inactive-hires')--}}
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
    @include('admin.vehicle.list-active-hire')
    @include('admin.vehicle.list-inactive-hires')
  </div>
    {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
      {{--@include('admin.vehicle.list-active-hire')--}}
    {{--</div>--}}
    {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
      {{--@include('admin.vehicle.list-inactive-hires')--}}
    {{--</div>--}}
</div>
@endsection