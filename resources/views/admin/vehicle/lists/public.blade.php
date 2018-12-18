<div class="col-lg-2 col-md-3 col-sm-3">
  <div class="panel panel-default">
    <div class="panel-body">
      <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs">
        <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
        @foreach(array_keys($vehicles->groupBy('type')->toArray()) as $key)
          <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
<div class="col-lg-10 col-sm-9">
  <div class="tab-content vehicles-tab-content">
    <div id="all" class="tab-pane fade in active">
      <div class="row">
        @foreach($vehicles as $vehicle)
          <div class="col-lg-6 col-sm-12">
            @include('admin.vehicle.summaries.public')
          </div>
        @endforeach
      </div>
    </div>
    @for($i = 0; $i < count($vehicles->groupBy('type')); $i++)
      <div id="{{ str_replace(" ", "-", array_keys($vehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
        <div class="row">
          @foreach($vehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
            <div class="col-lg-6 col-sm-12">
              @include('admin.vehicle.summaries.public')
            </div>
          @endforeach
        </div>
      </div>
    @endfor
  </div>
</div>