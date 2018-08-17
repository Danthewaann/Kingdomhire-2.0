@extends('layouts.public')

@section('content')
@foreach($vehicles as $vehicle)
  @include('admin.vehicle.modal-gallery')
@endforeach
<div class="jumbotron jumbotron-header">
  <div class="container">
    <h1>Our fleet</h1>
    <p>Below are all the vehicles in that are in our fleet</p>
  </div>
</div>
<div class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-3 col-sm-3">
        <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
          <li class="active"><a href="#all" data-toggle="pill">All</a></li>
          @foreach(array_keys($vehicles->groupBy('type')->toArray()) as $key)
            <li><a data-toggle="pill" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
          @endforeach
        </ul>
      </div>
      <div class="col-lg-10 col-md-9 col-sm-9">
        <div class="tab-content vehicles-tab-content">
          <div id="all" class="tab-pane fade in active">
            <div class="row">
              @foreach($vehicles as $vehicle)
                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-12">
                  @include('admin.vehicle.public-summary')
                </div>
              @endforeach
            </div>
          </div>
          @for($i = 0; $i < count($vehicles->groupBy('type')); $i++)
            <div id="{{ str_replace(" ", "-", array_keys($vehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
              <div class="row">
                @foreach($vehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
                  <div class="col-lg-4 col-md-6 col-sm-4 col-xs-12">
                    @include('admin.vehicle.public-summary')
                  </div>
                @endforeach
              </div>
            </div>
          @endfor
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
