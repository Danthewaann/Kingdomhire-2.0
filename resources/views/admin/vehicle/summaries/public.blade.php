<div class="panel panel-default public-vehicle-panel">
  <div class="panel-heading vehicle-panel-heading">
    <h3>{{ $vehicle->name() }}</h3>
  </div>
    @if($vehicle->images->isEmpty())
      <div class="vehicle-img">
        <div class="vehicle-img-na">
          <h2 class="public"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;No Image(s)</h2>
        </div>
      </div>
    @else
      <div class="vehicle-img">
      <img class="public" src="{{ asset($vehicle->images->first()->image_uri) }}" alt="{{ $vehicle->name() . ' - ' . $vehicle->images->first()->name }}">
        <button class="btn btn-info vehicle-img-button vehicle-open-modal" data-vehicle="{{ $vehicle->slug }}">View images</button>
      </div>
    @endif
  <table class="table table-condensed vehicle-table-public">
    <tr>
      <th class="first">Vehicle Type</th>
      <td class="first">@if($vehicle->type != null) {{ $vehicle->type->name }} @else N/A @endif</td>
    </tr>
    <tr>
      <th>Fuel Type</th>
      <td>@if($vehicle->fuelType != null) {{ $vehicle->fuelType->name }} @else N/A @endif</td>
    </tr>
    <tr>
      <th>Gear Type</th>
      <td>@if($vehicle->gearType != null) {{ $vehicle->gearType->name }} @else N/A @endif</td>
    </tr>
    <tr>
      <th class="last">Seats</th>
      <td class="last">{{ $vehicle->seats }}</td>
    </tr>
  </table>
</div>