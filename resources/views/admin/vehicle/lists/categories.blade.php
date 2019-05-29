<div class="panel panel-default">
  @if(App\Vehicle::count() < 1)
    <div class="panel-heading">
      <h3>No vehicles present</h3>
    </div>
    <div class="panel-body" style="padding: 0">
      <a class="btn btn-lg btn-primary" style="width: 100%; border: 0; border-radius: 0" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
    </div>
  @else
    <div class="panel-heading">
      <h3>Vehicles</h3>
      <h5>{{ $vehicleCount }} vehicle(s) in total</h5>
    </div>
    <div class="panel-body" style="padding: 0">
      <a class="btn btn-lg btn-primary" style="width: 100%; border: 0; border-radius: 0" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
    </div>
    <div class="panel-footer">
      <h4>Vehicle Types</h3>
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
        @if($inactiveVehicles->isNotEmpty())
          <li class="{{ $activeVehicles->isEmpty() ? 'active' : '' }}"><a data-toggle="pill" class="btn" href="#discontinued">Discontinued</a></li>
        @endif
      </ul>
    </div>
  @endif
</div>