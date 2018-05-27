<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$reservations->isEmpty())
      <h3>Active reservations</h3>
    @else
      <h3>No active reservations</h3>
    @endif
  </div>
  @if((!$reservations->isEmpty()))
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th>Vehicle</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          @foreach($reservations->sortBy('end_date') as $reservation)
            <tr>
              <td><a href="{{ route('vehicle.show', ['make' => $reservation->vehicle->make, 'model' => $reservation->vehicle->model, 'id' => $reservation->vehicle->id]) }}">{{ $reservation->vehicle->name() }}</a></td>
              <td>{{ $reservation->start_date }}</td>
              <td>{{ $reservation->end_date }}</td>
              <td>
                {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
              </td>
              <td>
                <a href="{{ route('reservation.editForm', ['make' => $reservation->vehicle->make, 'model' => $reservation->vehicle->model, 'vehicle_id' => $reservation->vehicle->id, 'reservation_id' => $reservation->id]) }}"
                   class="btn btn-primary" role="button" aria-pressed="true">Re-schedule</a>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  @endif
</div>
