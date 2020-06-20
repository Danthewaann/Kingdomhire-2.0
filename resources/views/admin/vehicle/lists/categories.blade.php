<div class="panel panel-default vehicle-categories{{ Request::is('admin/vehicles') ? '-admin' : '-public' }}">
  <div class="panel-heading">
    @if(Request::is('admin/vehicles'))
      <h2>Our Fleet of Vehicles</h2>
      <hr>
      <a class="btn btn-lg btn-primary add-vehicle-btn" style="width: 100%" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
    @else
      <h2 class="public">Vehicle Search</h2>
    @endif  
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          @if(Request::is('admin/vehicles'))
          <div class="col-lg-12">
            <div class="vehicle-search-section"><h4>Vehicle Types</h4></div>
              <li id="vehicle-type-options" class="dropdown nav vehicle-category-selection">
                <a id="vehicle_types_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="vehicle_types"class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Seats</h4></div>
              <li id="seat-options" class="dropdown nav vehicle-category-selection">
                <a id="seats_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="seats" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Fuel Types</h4></div>
              <li id="fuel-type-options" class="dropdown nav vehicle-category-selection">
                <a id="fuel_types_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="fuel_types" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Gear Types</h4></div>
              <li id="gear-type-options" class="dropdown nav vehicle-category-selection">
                <a id="gear_types_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="gear_types" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Status</h4></div>
              <li id="vehicle-state-options" class="dropdown nav vehicle-category-selection">
                <a id="vehicle_state_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="vehicle_states" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
          @else
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Vehicle Types</h4></div>
              <li id="vehicle-type-options" class="dropdown nav vehicle-category-selection">
                <a id="vehicle_types_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="vehicle_types" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Seats</h4></div>
              <li id="seat-options" class="dropdown nav vehicle-category-selection">
                <a id="seats_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="seats" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Fuel Types</h4></div>
              <li id="fuel-type-options" class="dropdown nav vehicle-category-selection">
                <a id="fuel_types_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="fuel_types" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
            <div class="col-lg-12">
              <div class="vehicle-search-section"><h4>Gear Types</h4></div>
              <li id="gear-type-options" class="dropdown nav vehicle-category-selection">
                <a id="gear_types_selection" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="caret"></span></a>
                <ul id="gear_types" class="dropdown-menu vehicle-category-options"></ul>
              </li>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <div class="row">
      <div class="col-lg-12">
        <div class="btn-group" style="float: right; width: 100%">
          <div class="btn-group" style="width: 70%">
            <button type="button" style="width: 100%" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sort Vehicles <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li class="active" id="vehicle-sort-ascending"><a>Ascending</a></li>
              <li id="vehicle-sort-descending"><a>Descending</a></li>
            </ul>
          </div>
          <div class="btn-group" style="width: 30%"><button style="width: 100%" id="vehicle-search-reset" class="btn btn-primary">Reset</button></div>
        </div>
      </div>
    </div>
  </div>
</div>