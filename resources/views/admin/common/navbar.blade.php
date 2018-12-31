<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Admin Dashboard</h3>
  </div>
  <div class="panel-body">
    <a class="btn btn-lg btn-primary {{ Request::is('admin') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.home') }}">Home</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/vehicles') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.vehicles.index') }}">Vehicles</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/reservations*') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.reservations.index') }}">Reservations</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/hires*') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.hires.index') }}">Hires</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/weekly-rates*') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.weekly-rates.index') }}">Weekly Rates</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/vehicle-types*') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.vehicle-types.index') }}">Vehicle Types</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/vehicle-gear-types*') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.vehicle-gear-types.index') }}">Gear Types</a>
    <a class="btn btn-lg btn-primary {{ Request::is('admin/vehicle-fuel-types*') ? 'active' : '' }}" style="width: 100%; border-radius: 0" role="button" href="{{ route('admin.vehicle-fuel-types.index') }}">Fuel Types</a>
  </div>
</div>