@if($vehicleCount < 1)
  <div class="col-sm-12">
    <h1 style="text-align: center">No Vehicles</h1>
    <h3 style="text-align: center">Come back later!</h3>
  </div>
@else
  <div class="col-lg-12 col-md-5 col-sm-6">
    <div class="panel panel-default vehicle-categories">
      <div class="panel-heading">
        <h3>Vehicle Search Options</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
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
  </div>
  <div class="col-lg-12 col-md-7 col-sm-6">
    <div class="row tab-content" id="vehicle-search-results" href="#vehicle-search-results-tab">
    </div>
  </div>
@endif