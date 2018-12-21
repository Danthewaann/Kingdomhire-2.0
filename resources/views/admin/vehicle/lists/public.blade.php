<div class="col-lg-2 col-md-3 col-sm-3">
  <div class="panel panel-default">
    <div class="panel-body" style="padding: 0">
      <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
        <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
        @foreach($vehicleTypes as $vehicleType)
          @if($vehicleType->vehicles->count() > 0)
            <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $vehicleType->name) }}">{{ $vehicleType->name }}s</a></li>
          @endif
        @endforeach
      </ul>
    </div>
  </div>
</div>
<div class="col-lg-10 col-sm-9">
  <div class="tab-content">
    <div id="all" class="tab-pane fade in active">
      <div class="row">
        @foreach($vehicleTypes as $vehicleType)
          @if($vehicleType->vehicles->count() > 0)
            @foreach($vehicleType->vehicles as $vehicle)
              <div class="col-lg-6 col-sm-12">
                @include('admin.vehicle.summaries.public')
              </div>
            @endforeach
          @endif
        @endforeach
      </div>
    </div>
    @foreach($vehicleTypes as $vehicleType)
      @if($vehicleType->vehicles->count() > 0)
        <div id="{{ str_replace(" ", "-", $vehicleType->name) }}" class="tab-pane fade">
          <div class="row">
            @foreach($vehicleType->vehicles as $vehicle)
              <div class="col-lg-6 col-sm-12">
                @include('admin.vehicle.summaries.public')
              </div>
            @endforeach
          </div>
        </div>
      @endif
    @endforeach
  </div>
</div>