@if($activeVehicles->isNotEmpty() or $inactiveVehicles->isNotEmpty())
  <div class="tab-content vehicles-tab-content">
    @if($activeVehicles->isNotEmpty())
      <div id="all" class="tab-pane fade in active">
        <div class="row">
          @foreach($activeVehicles as $vehicle)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
              @include('admin.vehicle.admin-summary')
            </div>
          @endforeach
        </div>
      </div>
      @for($i = 0; $i < count($activeVehicles->groupBy('type')); $i++)
        <div id="{{ str_replace(" ", "-", array_keys($activeVehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
          <div class="row">
            @foreach($activeVehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                @include('admin.vehicle.admin-summary')
              </div>
            @endforeach
          </div>
        </div>
      @endfor
    @endif
    @if($inactiveVehicles->isNotEmpty())
      <div id="discontinued" class="tab-pane fade{{ $activeVehicles->isEmpty() ? ' in active' : '' }}">
        <div class="row">
          @foreach($inactiveVehicles as $vehicle)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
              @include('admin.vehicle.admin-summary')
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>
@endif