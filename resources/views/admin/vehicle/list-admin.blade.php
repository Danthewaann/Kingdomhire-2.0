{{--<div class="row">--}}
  {{--<div class="col-md-2">--}}
    {{--@if($activeVehicles->isEmpty() and $inactiveVehicles->isEmpty())--}}
      {{--<h3>No vehicles present</h3>--}}
    {{--@else--}}
      {{--<h3>Vehicles</h3>--}}
      {{--<h5>{{ $activeVehicles->count() + $inactiveVehicles->count() }} vehicle(s) in total</h5>--}}
    {{--@endif--}}
  {{--</div>--}}
  {{--@if($activeVehicles->isEmpty())--}}
  {{--<h3>No vehicles present</h3>--}}
  {{--@else--}}
  {{--<h3>Vehicles</h3>--}}
  {{--<h5>{{ count($activeVehicles) }} vehicle(s) in total</h5>--}}
  {{--@endif--}}
  {{--@if($gantt != null)--}}
  {{--<div class="col-md-10">--}}
  {{--<div style="padding: 0 0 30px 0; float: right; width: 100%">--}}
  {{--{!! $gantt !!}--}}
  {{--</div>--}}
  {{--</div>--}}
  {{--@endif--}}
{{--</div>--}}
<div class="well">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-2" style="text-align: center">
          @if($activeVehicles->isEmpty() and $inactiveVehicles->isEmpty())
            <h3>No vehicles present</h3>
          @else
            <h3>Vehicles</h3>
            <h5>{{ $activeVehicles->count() + $inactiveVehicles->count() }} vehicle(s) in total</h5>
          @endif
        {{--</div>--}}
        {{--@if($activeVehicles->isEmpty())--}}
          {{--<h3>No vehicles present</h3>--}}
        {{--@else--}}
          {{--<h3>Vehicles</h3>--}}
          {{--<h5>{{ count($activeVehicles) }} vehicle(s) in total</h5>--}}
        {{--@endif--}}
        </div>
        @if($gantt != null)
          <div class="col-md-10">
            <div class="panel panel-default">
            {{--<div style="padding: 0 0 30px 0; width: 100%">--}}
              <div class="scrollable-list" style="max-height: 200px">
              {!! $gantt !!}
              </div>
            {{--</div>--}}
            </div>
          </div>
        @endif
      </div>
    </div>
    @if($activeVehicles->isNotEmpty() or $inactiveVehicles->isNotEmpty())
      <div class="col-lg-2 col-md-2 col-sm-2">
        <ul class="nav nav-pills nav-stacked vehicle-navbar-tabs" id="myTabs" style="margin-bottom: 10px">
          @if($activeVehicles->isNotEmpty())
            <li class="active"><a href="#all" class="btn" data-toggle="pill">All</a></li>
            @foreach(array_keys($activeVehicles->groupBy('type')->toArray()) as $key)
              <li><a data-toggle="pill" class="btn" href="#{{ str_replace(" ", "-", $key) }}">{{ $key }}s</a></li>
            @endforeach
          @endif
          @if($inactiveVehicles->isNotEmpty())
            <li class="{{ $activeVehicles->isEmpty() ? 'active' : '' }}"><a data-toggle="pill" class="btn" href="#discontinued">Discontinued</a></li>
          @endif
        </ul>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-10">
        <div class="tab-content vehicles-tab-content">
          @if($activeVehicles->isNotEmpty())
            <div id="all" class="tab-pane fade in active">
              <div class="row">
                @foreach($activeVehicles as $vehicle)
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    @include('admin.vehicle.admin-summary')
                  </div>
                @endforeach
              </div>
            </div>
            @for($i = 0; $i < count($activeVehicles->groupBy('type')); $i++)
              <div id="{{ str_replace(" ", "-", array_keys($activeVehicles->groupBy('type')->toArray())[$i]) }}" class="tab-pane fade">
                <div class="row">
                  @foreach($activeVehicles->groupBy('type')->slice($i, 1)->first() as $vehicle)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                      @include('admin.vehicle.admin-summary')
                    </div>
                  @endforeach
                </div>
              </div>
            @endfor
          @endif
          @if($inactiveVehicles->isNotEmpty())
            <div id="discontinued" class="tab-pane fade{{ $activeVehicles->isEmpty() ? ' in active' : '' }}">
              <div class="row">
                @foreach($inactiveVehicles as $vehicle)
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    @include('admin.vehicle.admin-summary')
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        </div>
      </div>
    @endif
  </div>
</div>