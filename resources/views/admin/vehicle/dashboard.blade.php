@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
    @include('admin.vehicle.navbar')
    @if($gantt != null)
      <div class="row">
        <div class="col-md-12 col-xs-12">
          @include('admin.vehicle.gantt')
        </div>
      </div>
    @endif
  </div>
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    @include('admin.vehicle.list-active-hire')
    @include('admin.vehicle.list-reservations')
  </div>
  {{--<div class="col-md-9">--}}
    {{--<div class="row">--}}
      {{--@if($gantt != null)--}}
        {{--<div class="col-md-12 col-xs-12">--}}
          {{--@include('admin.vehicle.gantt')--}}
        {{--</div>--}}
      {{--@endif--}}
      {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
        {{--@include('admin.vehicle.list-active-hire')--}}
      {{--</div>--}}
      {{--<div class="col-md-3 col-sm-6 col-xs-12">--}}
        {{--@include('admin.vehicle.list-reservations')--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}
</div>
@endsection