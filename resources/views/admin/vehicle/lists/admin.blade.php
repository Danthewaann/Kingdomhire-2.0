@if($activeVehicles->isNotEmpty() or $inactiveVehicles->isNotEmpty())
  <div class="tab-content">
    @if($activeVehicles->isNotEmpty())
      <div id="all" class="tab-pane fade in active">
        <div class="row">
          @foreach($activeVehicles->sortByDesc('created_at') as $vehicle)
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
              @include('admin.vehicle.summaries.admin-dashboard')
            </div>
          @endforeach
        </div>
      </div>
      @foreach($vehicleTypes as $vehicleType)
        @if($vehicleType->vehicles->isNotEmpty())
          <div id="{{ str_replace(" ", "-", $vehicleType->name) }}" class="tab-pane fade">
            <div class="row">
              @foreach($vehicleType->vehicles->sortByDesc('created_at') as $vehicle)
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                  @include('admin.vehicle.summaries.admin-dashboard')
                </div>            
              @endforeach
            </div>
          </div>
        @endif
      @endforeach
    @endif
    @if($inactiveVehicles->isNotEmpty())
      <div id="discontinued" class="tab-pane fade{{ $activeVehicles->isEmpty() ? ' in active' : '' }}">
        <div class="row">
          @foreach($inactiveVehicles->sortByDesc('deleted_at') as $vehicle)
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
              @include('admin.vehicle.summaries.admin-dashboard')
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
@endif