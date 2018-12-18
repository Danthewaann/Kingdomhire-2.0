<div class="panel panel-default">
  <div class="panel-heading" style="background-color: #3b8b63">
    <h3 style="text-align: center">{{ $vehicle->name() }}</h3>
  </div>
  <div style="display: inline-block; width: 100%;">
    @if($vehicle->images->isEmpty())
      <div class="vehicle-img">
        <span style="display: inline-block;">
          <h2 style="margin: 0"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Image N/A</h2>
        </span>
      </div>
    @else
      <div style="position: relative">
        <img src="{{ $vehicle->images->first()->image_uri }}" class="vehicle-img"/>
        <div style="position: absolute; left: 0; top: 262px">
          <button class="btn btn-info vehicle-img-button"
                  onclick="
                    openModal('{{ $vehicle->slug }}');
                    currentSlide(1, '{{ $vehicle->slug.'-images' }}')
                    "
          >View images</button>
        </div>
      </div>
    @endif
    <table class="table table-condensed vehicle-table-dashboard">
      <tr>
        <th class="first">Vehicle Id</th>
        <td class="first">{{ $vehicle->id }}</td>
      </tr>
      <tr>
        <th>Status</th>
        <td>{{ $vehicle->status }}</td>
      </tr>
      <tr>
        <th>Vehicle Type</th>
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
        <th class="last">Weekly Rate</th>
        <td class="last">
          @if($vehicle->rate != null)
            {{ $vehicle->rate->getFullName() }}
          @else
            N/A
          @endif
        </td>
      </tr>
    </table>
  </div>
</div>