@if($activeVehicles->isNotEmpty() or $inactiveVehicles->isNotEmpty())
  <div class="tab-content">
    @if($activeVehicles->isNotEmpty())
      <div id="all" class="tab-pane fade in active">
        <div class="row">
          @foreach($activeVehicles as $vehicle)
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
                  <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              @include('admin.vehicle.summaries.admin-dashboard')
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
@endif