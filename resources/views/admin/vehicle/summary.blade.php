<div class="panel panel-default" style="min-width: 45%; width: 500px; max-width: 100%; float: left; color: #636b6f">
  <div class="panel-heading" style="padding: unset">
    @foreach($vehicle->images as $image)
      @if($loop->first) <img src="{{ $image->image_uri }}" style="width: 100%; height: 250px;"/> @endif
    @endforeach
  </div>
  <table class="table table-bordered table-condensed" style="min-height: 350px">
    <tr>
      <td>Vehicle</td>
      <td>{{ $vehicle->name() }}</td>
    </tr>
    <tr>
      <td>Type</td>
      <td>{{ $vehicle->type }}</td>
    </tr>
    <tr>
      <td>Fuel Type</td>
      <td>{{ $vehicle->fuel_type }}</td>
    </tr>
    <tr>
      <td>Gear Type</td>
      <td>{{ $vehicle->gear_type }}</td>
    </tr>
    <tr>
      <td>Seats</td>
      <td>{{ $vehicle->seats }}</td>
    </tr>
    <tr>
      <td>Status</td>
      <td>{{ $vehicle->status }}</td>
    </tr>
    <tr>
      <td>Weekly Price Rate</td>
      <td>{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</td>
    </tr>
  </table>
</div>