<div style="display: inline-block; width: 100%; margin-bottom: 20px">
  @if($vehicle->images->isEmpty())
    <div class="vehicle-img thumbnail text-link">
      <span style="display: inline-block;">
        <h2 style="margin: 0"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Image N/A</h2>
      </span>
    </div>
  @else
    @foreach($vehicle->images as $image)
      <div style="position: relative">
        @if($loop->first) <img src="{{ $image->image_uri }}" class="thumbnail vehicle-img"/> @endif
        <div style="position: absolute; left: 5px; top: 236px">
          <button class="btn btn-info vehicle-img-button">View images</button>
        </div>
      </div>
    @endforeach
  @endif
  <table class="table table-condensed vehicle-table-public">
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
      <th class="last">Weekly Rate</th>
      <td>
        @if($vehicle->rate != null)
          {{ $vehicle->rate->name }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})
        @else
          N/A
        @endif
      </td>
    </tr>
  </table>
</div>