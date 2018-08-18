<div style="display: inline-block; width: 100%; margin-bottom: 20px">
  @if($vehicle->images->isEmpty())
    <div class="vehicle-img vehicle-dashboard-img">
      <span style="display: inline-block;">
        <h2 style="margin: 0"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Image N/A</h2>
      </span>
    </div>
  @else
    <div style="position: relative">
      <img src="{{ $vehicle->images->first()->image_uri }}" class="vehicle-img vehicle-dashboard-img"/>
      <div style="position: absolute; left: 1px; top: 239px">
        <button class="btn btn-info vehicle-img-button" onclick="openModal('{{ str_replace(" ", "-", $vehicle->name()) }}');currentSlide(1, '{{ str_replace(" ", "-", $vehicle->name()).'-images' }}')">View images</button>
      </div>
    </div>
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
          {{ $vehicle->rate->getFullName() }}
        @else
          N/A
        @endif
      </td>
    </tr>
  </table>
</div>