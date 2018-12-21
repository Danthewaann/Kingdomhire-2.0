<div class="col-lg-2 col-md-4 col-sm-3 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      @php ($hasVehicle = false)
      @foreach($vehicleTypes as $vehicleType)
        @if($vehicleType->vehicles->isNotEmpty())
          @php ($hasVehicles = true)
          @break
        @endif
      @endforeach
      @if($hasVehicles == false)
        <h3 style="text-align: center; margin-top: 0">No vehicles present</h3>
      @else
        <h3 style="text-align: center; margin-top: 0">Vehicles</h3>
        <h5 style="text-align: center">{{ $activeVehicles->count() + $inactiveVehicles->count() }} vehicle(s) in total</h5>
      @endif
    </div>
    <div class="panel-body" style="padding: 0;">
      <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
        @if($activeVehicles->isNotEmpty())
          <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
          @foreach($vehicleTypes as $vehicleType)
            @if($vehicleType->vehicles->count() > 0)
              <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $vehicleType->name) }}">{{ $vehicleType->name }}s</a></li>
            @endif
          @endforeach
        @endif
        @if($inactiveVehicles->isNotEmpty())
          <li class="{{ $activeVehicles->isEmpty() ? 'active' : '' }}"><a data-toggle="pill" class="btn" href="#discontinued">Discontinued</a></li>
        @endif
      </ul>
    </div>
  </div>
</div>
<div class="col-lg-10 col-md-8 col-sm-9 col-xs-12">
  @if($activeVehicles->isNotEmpty() or $inactiveVehicles->isNotEmpty())
    <div class="tab-content">
      @if($activeVehicles->isNotEmpty())
        <div id="all" class="tab-pane fade in active">
          <div class="row">
            @foreach($activeVehicles as $vehicle)
              <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                @include('admin.vehicle.summaries.admin-dashboard')
              </div>
            @endforeach
          </div>
        </div>
        @foreach($vehicleTypes as $vehicleType)
          @if($vehicleType->vehicles->count() > 0)
            <div id="{{ str_replace(" ", "-", $vehicleType->name) }}" class="tab-pane fade">
              <div class="row">
                @foreach($vehicleType->vehicles as $vehicle)
                  @if(!$vehicle->trashed())
                    <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                      @include('admin.vehicle.summaries.admin-dashboard')
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          @endif
        @endforeach
      @endif
      @if($inactiveVehicles->isNotEmpty())
        <div id="discontinued" class="tab-pane fade{{ $activeVehicles->isEmpty() ? ' in active' : '' }}">
          <div class="row">
            @foreach($inactiveVehicles as $vehicle)
              <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                @include('admin.vehicle.summaries.admin-dashboard')
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  @endif
</div>