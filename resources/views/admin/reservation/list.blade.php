<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$reservations->isEmpty())
      <h3>Active reservations</h3>
      <span>{{ count($reservations) }} reservation(s) in total</span>
    @else
      <h3>No active reservations</h3>
    @endif
  </div>
  @if((!$reservations->isEmpty()))
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-hover table-sm">
          <thead>
          <tr>
            <th>Vehicle</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          @foreach($reservations as $reservation)
            <tr>
              <td><a href="{{ route('vehicle.show', ['id' => $reservation->vehicle->id]) }}">{{ $reservation->vehicle->name() }}</a></td>
              <td>{{ $reservation->start_date }}</td>
              <td>{{ $reservation->end_date }}</td>
              <td>
                {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
              </td>
              <td>
                <a href="{{ route('reservation.editForm', ['vehicle_id' => $reservation->vehicle->id, 'reservation_id' => $reservation->id]) }}"
                   class="btn btn-primary" role="button" aria-pressed="true">Re-schedule</a>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  @endif
</div>
