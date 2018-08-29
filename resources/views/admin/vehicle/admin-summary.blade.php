<div class="panel panel-default">
  <div class="panel-heading" style="background-color: #3b8b63">
    <h3 style="text-align: center">{{ $vehicle->name() }}</h3>
  </div>
  @if($vehicle->images->isEmpty())
    <div style="position: relative">
      <div class="vehicle-img">
        <span style="display: inline-block;">
          <h2 style="margin: 0"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Image N/A</h2>
        </span>
      </div>
      <div style="position: absolute; left: 0; top: 165px;">
        <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->id]) }}" class="btn btn-primary vehicle-img-button">Dashboard</a>
      </div>
    </div>
  @else
    @foreach($vehicle->images as $image)
      @if($loop->first)
        <div style="position: relative">
          @if($loop->first) <img src="{{ $image->image_uri }}" class="vehicle-img"/> @endif
            <div style="position: absolute; left: 0; top: 165px;">
              <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->id]) }}" class="btn btn-info vehicle-img-button">Dashboard</a>
            </div>
        </div>
      @endif
    @endforeach
  @endif
  <table class="table table-condensed vehicle-table-admin">
    <tr>
      <th class="first">Status</th>
      <td class="first">{{ $vehicle->status }}</td>
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

