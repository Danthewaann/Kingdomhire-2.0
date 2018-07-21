@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
  <div class="container">
    <h1>Our fleet</h1>
    <p>Below are all the vehicles in that are in our fleet</p>
  </div>
</div>
<div class="jumbotron jumbotron-content">
  <div class="container">
    <ul class="nav navbar-default nav-tabs">
      <li class="active"><a data-toggle="tab" href="#all">All</a></li>
      @foreach(array_keys($vehicles->groupBy('type')->toArray()) as $key)
        <li><a data-toggle="tab" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
      @endforeach
    </ul>
    <div class="tab-content vehicles-tab-content">
      <div id="all" class="tab-pane fade in active">
        <div class="row">
          @foreach($vehicles as $vehicle)
            <div class="col-md-4 col-xs-12">
              @include('admin.vehicle.summary')
            </div>
          @endforeach
        </div>
      </div>
      @for($i = 0; $i < count($vehicles->groupBy('type')); $i++)
        <div id="{{ str_replace(" ", "-", array_keys($vehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
          <div class="row">
            @foreach($vehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
              <div class="col-md-4 col-xs-12">
                @include('admin.vehicle.summary')
              </div>
            @endforeach
          </div>
        </div>
      @endfor
    </div>
  </div>
</div>
@endsection
