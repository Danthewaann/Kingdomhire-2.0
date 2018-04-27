<img src="{{ $vehicle->image_path }}" style="width: 100%; max-height: 225px;"/>
<table class="table">
  <tr>
    <td>Make</td>
    <td>{{ $vehicle->make }}</td>
  </tr>
  <tr>
    <td>Model</td>
    <td>{{ $vehicle->model }}</td>
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
</table>
