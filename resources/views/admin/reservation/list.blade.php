<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$reservations->isEmpty())
      <h3>Current reservations</h3>
    @else
      <h3>No current reservations</h3>
    @endif
  </div>
  @if(!$reservations->isEmpty())
    <div class="panel-body">
      <table class="table">
        <thead>
        <tr>
          @if($vehicles->count() > 1)
            <th>Vehicle</th>
          @endif
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        @foreach($vehicles as $vehicle)
          @foreach($vehicle->reservations as $reservation)
            <tr>
              @if($vehicles->count() > 1)
                <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
              @endif
              <td>{{ $reservation->start_date }}</td>
              <td>{{ $reservation->end_date }}</td>
              <td>{{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        @endforeach
      </table>
    </div>
  @endif
</div>
