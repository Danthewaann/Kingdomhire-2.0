<div class="panel panel-default">
  <div class="panel-heading vehicle-panel-admin-heading">
    <h3>{{ $vehicle->name() }}</h3>
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
      <img class="admin" src="{{ $vehicle->images->first()->image_uri }}"/>
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
        @if($vehicle->hasActiveHire())
          {{ $vehicle->getActiveHire()->name }}<br>
          {{ date('j/M/Y', strtotime($vehicle->getActiveHire()->start_date)) }} to<br>
          {{ date('j/M/Y', strtotime($vehicle->getActiveHire()->end_date)) }}
        @else
          No active hire
        @endif
      </td>
    </tr>
    <tr>
      <th>Next Reservation</th>
      <td>
        @if($vehicle->reservations->isNotEmpty())
          {{ $vehicle->getNextReservation()->name }}<br>
          {{ date('j/M/Y', strtotime($vehicle->getNextReservation()->start_date)) }} to<br>
          {{ date('j/M/Y', strtotime($vehicle->getNextReservation()->end_date)) }}
        @else
          No reservations
        @endif
      </td>
    </tr>
    <tr>
      <th class="last">Weekly Rate</th>
      <td class="last">@if($vehicle->rate != null) {{ $vehicle->rate->getFullName() }} @else N/A @endif</td>
    </tr>
  </table>
</div>

