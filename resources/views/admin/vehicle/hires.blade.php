@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
      @include('admin.vehicle.summary')
    </div>
    <div class="col-md-9 col-sm-4 col-xs-12">
      @include('admin.vehicle.navbar')
      <div class="row">
        @if($pastHires->isNotEmpty())
          <div class="col-md-5 col-sm-4 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading panel-title-text"><h3>Hires per month for {{ date('Y') }}</h3></div>
              <div class="panel-body" style="padding: unset">
                <div id="hires_per_month"></div>
              </div>
            </div>
            @columnchart('Hires per month', 'hires_per_month')
          </div>
        @endif
        <div class="col-md-4 col-sm-4 col-xs-12">
          @include('admin.vehicle.list-active-hire')
          @include('admin.vehicle.list-inactive-hires')
        </div>
      </div>
  </div>
</div>
@endsection