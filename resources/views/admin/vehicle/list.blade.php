@if($vehicle->images->isEmpty())
  <div style="position: relative">
    <div class="vehicle-img thumbnail text-link">
      <span style="display: inline-block;">
        <h2 style="margin: 0"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Image N/A</h2>
      </span>
    </div>
    <div style="position: absolute; left: 5px; top: 236px;">
      <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}" class="btn btn-primary vehicle-img-button">Dashboard</a>
      {{--<button class="btn btn-primary btn-sm">{{ $vehicle->name() }} dashboard</button>--}}
    </div>
  </div>
@else
  @foreach($vehicle->images as $image)
    @if($loop->first)
      <div style="position: relative">
        @if($loop->first) <img src="{{ $image->image_uri }}" class="vehicle-img thumbnail"/> @endif
          <div style="position: absolute; left: 5px; top: 236px;">
            <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}" class="btn btn-info vehicle-img-button">Dashboard</a>
            {{--<button class="btn btn-primary btn-sm">{{ $vehicle->name() }} dashboard</button>--}}
          </div>
      </div>
    @endif
  @endforeach
@endif
<table class="table table-condensed vehicle-table-admin">
  <tr>
    <th>Vehicle</th>
    <td class="first">{{ $vehicle->name() }}</td>
  </tr>
  <tr>
    <th>Status</th>
    <td>{{ $vehicle->status }}</td>
  </tr>
  <tr>
    <th>Weekly Rate</th>
    <td>
      @if($vehicle->rate != null)
        {{ $vehicle->rate->name }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})
      @else
        N/A
      @endif
    </td>
  </tr>
  <tr>
    <th>Active Hire</th>
    <td>
      @if($vehicle->hasActiveHire())
        Hired By: {{ $vehicle->getActiveHire()->hired_by }} <br>
        Starts: {{ date('jS F Y', strtotime($vehicle->getActiveHire()->start_date)) }} <br>
        Ends: {{ date('jS F Y', strtotime($vehicle->getActiveHire()->end_date)) }}
      @else
        No active hire
      @endif
    </td>
  </tr>
  <tr>
    <th class="last">Next Reservation</th>
    <td>
      @if($vehicle->reservations->isNotEmpty())
        Made By: {{ $vehicle->getNextReservation()->made_by }} <br>
        Starts: {{ date('jS F Y', strtotime($vehicle->getNextReservation()->start_date)) }} <br>
        Ends: {{ date('jS F Y', strtotime($vehicle->getNextReservation()->end_date)) }}
      @else
        No reservations
      @endif
    </td>
  </tr>
</table>

