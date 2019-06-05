@if($vehicleCount < 1)
  <div class="col-lg-12">
    <h1 style="text-align: center">No Vehicles</h2>
    <h3 style="text-align: center">Come back later!</h5>
  </div>
@else
  <div class="col-lg-3 col-md-3 col-sm-3">
    <div class="panel panel-default vehicle-categories">
      <div class="panel-heading">
        <h2>Our Fleet</h2>
      </div>
      <div class="panel-footer" style="border-top: 0">
        <h4>Vehicle Types</h4>
        <hr style="margin: 10px 10px 5px 10px">
        <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
          @if($activeVehicles->isNotEmpty())
            <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
            @foreach($vehicleTypes as $vehicleType)
              @if($vehicleType->vehicles->isNotEmpty())
                <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $vehicleType->name) }}">{{ $vehicleType->name }}s</a></li>
              @endif
            @endforeach
          @endif
          @if($vehiclesWithNoType->isNotEmpty())
            <li><a data-toggle="pill" class="btn" href="#na">N/A</a></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-9 col-sm-9">
    <div class="tab-content">
      @if($vehiclesWithType->isNotEmpty())
        <div id="all" class="tab-pane fade in active">
          <div class="row">
            @foreach($activeVehicles->sortByDesc('created_at') as $vehicle)
              <div class="col-lg-4 col-md-6 col-sm-6">
                @include('admin.vehicle.summaries.public')
              </div>
            @endforeach
          </div>
        </div>
        @foreach($vehicleTypes as $vehicleType)
          <div id="{{ str_replace(" ", "-", $vehicleType->name) }}" class="tab-pane fade">
            <div class="row">
              @foreach($vehiclesWithType->where('vehicle_type_id', $vehicleType->id)->sortByDesc('created_at') as $vehicle)
                <div class="col-lg-4 col-md-6 col-sm-6">
                  @include('admin.vehicle.summaries.public')
                </div>           
              @endforeach
            </div>
          </div>
        @endforeach
      @endif
      @if($vehiclesWithNoType->isNotEmpty())
        <div id="na" class="tab-pane fade{{ $vehiclesWithType->isEmpty() ? ' in active' : '' }}">
          <div class="row">
            @foreach($vehiclesWithNoType->sortByDesc('created_at') as $vehicle)
              <div class="col-lg-4 col-md-6 col-sm-6">
                @include('admin.vehicle.summaries.public')
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  </div>
@endif