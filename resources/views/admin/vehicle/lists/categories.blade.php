 <div class="panel panel-default vehicle-categories{{ Request::is('admin/vehicles') ? '-admin' : '-public' }}">
  <div class="panel-heading">
    @if(Request::is('admin/vehicles'))
      <h2>Our Fleet of Vehicles</h2>
      <hr>
      <a class="btn btn-lg btn-primary add-vehicle-btn" style="width: 100%" role="button" href="{{ route('admin.vehicles.create') }}"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle</a>
    @else
      <h2 class="public">Our Fleet of Vehicles</h2>
    @endif
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          @if(Request::is('admin/vehicles'))
            <div class="col-lg-4">
              <div class="vehicle-search-section"><h4>Vehicle Types</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="vehicle_types" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-2">
              <div class="vehicle-search-section"><h4>Seats</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="seats" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-2">
              <div class="vehicle-search-section"><h4>Fuel Types</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="fuel_types" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-2">
              <div class="vehicle-search-section"><h4>Gear Types</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="gear_types" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-2">
              <div class="vehicle-search-section"><h4>Status</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="vehicle_states" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
          @else
            <div class="col-lg-5">
              <div class="vehicle-search-section"><h4>Vehicle Types</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="vehicle_types" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-3">
              <div class="vehicle-search-section"><h4>Seats</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="seats" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-2">
              <div class="vehicle-search-section"><h4>Fuel Types</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="fuel_types" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
            <div class="col-lg-2">
              <div class="vehicle-search-section"><h4>Gear Types</h4></div>
              <hr class="vehicle-search-hr-bottom">
              <ul id="gear_types" class="nav nav-pills nav-stacked vehicle-navbar-tabs">
              </ul>
              <hr class="vehicle-search-hr-bottom">
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="panel-footer">
    <div class="row">
      <div class="col-lg-4 col-lg-offset-8 col-sm-12">
        <div class="btn-group" style="float: right; width: 100%">
          <div class="btn-group" style="width: 70%">
            <button type="button" style="width: 100%" class="btn btn-lg btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Sort Vehicles <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li class="active" id="vehicle-sort-ascending"><a>Ascending</a></li>
              <li id="vehicle-sort-descending"><a>Descending</a></li>
            </ul>
          </div>
          <div class="btn-group" style="width: 30%"><button style="width: 100%" id="vehicle-search-reset" class="btn btn-lg btn-primary">Reset</button></div>
        </div>
      </div>
    </div>
  </div>
</div>