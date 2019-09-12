<div class="panel panel-default">
  <div class="panel-heading vehicle-panel-admin-heading">
    <h3>{{ $vehicle->make_model }}</h3>
  </div>
  @if($vehicle->images->isEmpty())
    <div class="vehicle-img">
      <div class="vehicle-img-na">
        <h2 class="admin"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;No Image(s)</h2>
      </div>
      <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->slug]) }}" class="btn btn-info vehicle-img-button">Dashboard</a>
    </div>
  @else
    <div class="vehicle-img">
      <img class="admin" src="{{ asset($vehicle->images->first()->image_uri) }}"/>
        <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->slug]) }}" class="btn btn-info vehicle-img-button">Dashboard</a>
    </div> 
  @endif
  <table class="table table-condensed vehicle-table-admin">
    <tr>
      <th class="first">ID</th>
      <td class="first">{{ $vehicle->name }}</td>
    </tr>
    <tr>
      <th>Status</th>
      <td>{{ $vehicle->status }}</td>
    </tr>
    <tr>
      <th>Active Hire</th>
      <td>
        @php($activeHire = $vehicle->active_hire)
        @if($activeHire != null)
          {{ $activeHire->name }}<br>
          {{ date('j/M/Y', strtotime($activeHire->start_date)) }} to<br>
          {{ date('j/M/Y', strtotime($activeHire->end_date)) }}
        @else
          No active hire
        @endif
      </td>
    </tr>
    <tr>
      <th>Next Reservation</th>
      <td>
        @if($vehicle->reservations->isNotEmpty())
          {{ $vehicle->next_reservation->name }}<br>
          {{ date('j/M/Y', strtotime($vehicle->next_reservation->start_date)) }} to<br>
          {{ date('j/M/Y', strtotime($vehicle->next_reservation->end_date)) }}
        @else
          No reservations
        @endif
      </td>
    </tr>
    <tr>
      <th class="last">Weekly Rate</th>
      <td class="last">@if($vehicle->weekly_rate != null) {{ $vehicle->weekly_rate->full_name }} @else N/A @endif</td>
    </tr>
  </table>
</div>

