<div style="width: 210px; display: inline-block; padding: 10px;">
  <img src="{{ $vehicle->image_path }}" style="width: 100%; height: 125px;"/>
  <table class="table" style="max-width: 300px;">
    <tr>
      <th>Vehicle</th>
      <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->name() }}</a></td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ $vehicle->status }}</td>
    </tr>
    <tr>
      <th>Active</th>
      @if($vehicle->is_active == true)
        <td>Yes</td>
      @else
        <td>No</td>
      @endif
    </tr>
  </table>
</div>