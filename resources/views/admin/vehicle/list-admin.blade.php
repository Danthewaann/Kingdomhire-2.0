<div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
  @foreach($vehicle->images as $image)
    @if($loop->first) <img src="{{ $image->image_uri }}" style="width: 100%; height: 225px;"/> @endif
  @endforeach
  <table class="table table-hover table-condensed">
    <tr>
      <th>Vehicle</th>
      <td><a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">{{ $vehicle->name() }}</a></td>
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