<div class="well">
  <div class="row">
    <div class="col-md-12">
      @if($vehicles->isEmpty())
        <h3>No vehicles present</h3>
      @else
        <h3>Vehicles</h3>
        <h5>{{ count($vehicles) }} vehicle(s) in total</h5>
      @endif
    </div>
  </div>
  <ul class="nav nav-tabs nav-justified vehicle-navbar-tabs">
    <li class="active"><a data-toggle="tab" href="#all">All</a></li>
    @foreach(array_keys($vehicles->groupBy('type')->toArray()) as $key)
      <li><a data-toggle="tab" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
    @endforeach
  </ul>
  <div class="tab-content vehicles-tab-content-admin">
    <div id="all" class="tab-pane fade in active">
      <div class="row">
        @foreach($vehicles as $vehicle)
          <div class="col-md-4 col-xs-12">
            @include('admin.vehicle.list')
          </div>
        @endforeach
      </div>
    </div>
    @for($i = 0; $i < count($vehicles->groupBy('type')); $i++)
      <div id="{{ str_replace(" ", "-", array_keys($vehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
        <div class="row">
          @foreach($vehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
            <div class="col-md-4 col-xs-12">
              @include('admin.vehicle.list')
            </div>
          @endforeach
        </div>
      </div>
    @endfor
  </div>
</div>