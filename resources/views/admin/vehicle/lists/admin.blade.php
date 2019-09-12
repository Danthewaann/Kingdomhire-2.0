@if(count($jsonVehicles) < 1)
  <div class="col-sm-12" style="text-align: center">
    <h1>No Vehicles</h1>
    <h3>Why not add one?</h3>
    <hr>
    <a class="btn btn-lg btn-info add-vehicle-btn" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
  </div>
@else
  <div class="col-lg-12 col-md-5 col-sm-6">
    @include('admin.vehicle.lists.categories')
  </div>
  <div class="col-lg-12 col-md-7 col-sm-6 col-xs-12">
    <div class="row tab-content" id="vehicle-search-results" href="#vehicle-search-results-tab">
    </div>
  </div>
@endif