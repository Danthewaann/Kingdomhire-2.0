<div class="panel panel-default">
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
        <img class="public" src="{{ $vehicle->images->first()->image_uri }}"/>
        <button class="btn btn-info vehicle-img-button vehicle-open-modal" data-vehicle="{{ $vehicle->slug }}">View images</button>
      </div>
    @endif
  <table class="table table-condensed vehicle-table-public">
    <tr>
      <th class="first">ID</th>
      <td class="first">{{ $vehicle->name }}</td>
    </tr>
    <tr>
      <th>Vehicle Type</th>
      <td>@if($vehicle->type != null) {{ $vehicle->type->name }} @else N/A @endif</td>
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
    {{--<tr>--}}
      {{--<th class="last">Weekly Rate</th>--}}
      {{--<td class="last">@if($vehicle->rate != null) {{ $vehicle->rate->getFullName() }} @else N/A @endif</td>--}}
    {{--</tr>--}}
  </table>
</div>