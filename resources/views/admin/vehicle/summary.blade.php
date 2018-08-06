<div style="display: inline-block; width: 100%; margin-bottom: 20px">
  @foreach($vehicle->images as $image)
    @if($loop->first) <img src="{{ $image->image_uri }}" class="vehicle-img"/> @endif
  @endforeach
  <table class="table table-condensed vehicle-table">
    <tr>
      <th>Vehicle</th>
      <td class="first">{{ $vehicle->name() }}</td>
    </tr>
    <tr>
      <th>Type</th>
      <td>{{ $vehicle->type }}</td>
    </tr>
    <tr>
      <th>Fuel Type</th>
      <td>{{ $vehicle->fuel_type }}</td>
    </tr>
    <tr>
      <th>Gear Type</th>
      <td>{{ $vehicle->gear_type }}</td>
    </tr>
    <tr>
      <th>Seats</th>
      <td>{{ $vehicle->seats }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ $vehicle->status }}</td>
    </tr>
    <tr>
      <th class="last">Weekly Price Rate</th>
      <td>{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</td>
    </tr>
  </table>
</div>