<div class="col-md-2 col-sm-3 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      @if($activeVehicles->isEmpty() and $inactiveVehicles->isEmpty())
        <h3 style="text-align: center; margin-top: 0">No vehicles present</h3>
      @else
        <h3 style="text-align: center; margin-top: 0">Vehicles</h3>
        <h5 style="text-align: center">{{ $activeVehicles->count() + $inactiveVehicles->count() }} vehicle(s) in total</h5>
      @endif
    </div>
    <div class="panel-body">
      <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
        @if($activeVehicles->isNotEmpty())
          <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
          @foreach(array_keys($activeVehicles->groupBy('type')->toArray()) as $key)
            <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
          @endforeach
        @endif
        @if($inactiveVehicles->isNotEmpty())
          <li class="{{ $activeVehicles->isEmpty() ? 'active' : '' }}"><a data-toggle="pill" class="btn" href="#discontinued">Discontinued</a></li>
        @endif
      </ul>
    </div>
  </div>
</div>
<div class="col-md-10 col-sm-9 col-xs-12">
  @if($activeVehicles->isNotEmpty() or $inactiveVehicles->isNotEmpty())
    <div class="tab-content vehicles-tab-content">
      @if($activeVehicles->isNotEmpty())
        <div id="all" class="tab-pane fade in active">
          <div class="row">
            @foreach($activeVehicles as $vehicle)
              <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                @include('admin.vehicle.summaries.admin-dashboard')
              </div>
            @endforeach
          </div>
        </div>
        @for($i = 0; $i < count($activeVehicles->groupBy('type')); $i++)
          <div id="{{ str_replace(" ", "-", array_keys($activeVehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
            <div class="row">
              @foreach($activeVehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  @include('admin.vehicle.summaries.admin-dashboard')
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
                @include('admin.vehicle.summaries.admin-dashboard')
              </div>
            @endforeach
          </div>
        </div>
      @endif
    </div>
  @endif
</div>