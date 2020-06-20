@if(count($jsonVehicles) < 1)
  <div class="col-sm-12">
    <h1 style="text-align: center">No Vehicles</h1>
    <h3 style="text-align: center">Come back later!</h3>
  </div>
@else
  <div class="col-lg-3 col-md-5 col-sm-12">
    @include('admin.vehicle.lists.categories')
  </div>
  <div class="col-lg-9 col-md-7 col-sm-12">
    <div class="row tab-content" id="vehicle-search-results" href="#vehicle-search-results-tab">
    </div>
  </div>
@endif