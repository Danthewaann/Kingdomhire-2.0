{{--<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">--}}
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
{{--</div>--}}