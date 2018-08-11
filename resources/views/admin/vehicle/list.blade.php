@foreach($vehicle->images as $image)
  @if($loop->first)
    <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">
      @if($loop->first) <img src="{{ $image->image_uri }}" class="vehicle-img"/> @endif
    </a>
  @endif
@endforeach
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

