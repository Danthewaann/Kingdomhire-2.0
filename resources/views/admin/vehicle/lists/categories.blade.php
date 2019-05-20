<div class="panel panel-default">
  @php ($hasVehicles = false)
  @foreach($vehicleTypes as $vehicleType)
    @if($vehicleType->vehicles->isNotEmpty())
      @php ($hasVehicles = true)
      @break
    @endif
  @endforeach
  @if($hasVehicles == false)
    <div class="panel-heading">
      <h3>No vehicles present</h3>
    </div>
    <div class="panel-body">
      <a class="btn btn-lg btn-primary" style="width: 100%; border: 0; border-radius: 0" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
    </div>
  @else
    <div class="panel-heading">
      <h3>Vehicles</h3>
      <h5>{{ $activeVehicles->count() + $inactiveVehicles->count() }} vehicle(s) in total</h5>
    </div>
    <div class="panel-body" style="padding: 0">
      <a class="btn btn-lg btn-primary" style="width: 100%; border: 0; border-radius: 0" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
    </div>
    <div class="panel-footer" style="padding: 0;">
      <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
        @if($vehicleTypes->isNotEmpty())
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
  @endif
</div>