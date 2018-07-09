<div class="panel panel-default">
  <div class="panel-heading panel-title-text">
    @if(!$reservations->isEmpty())
      <h3>Active reservations</h3>
      <span>{{ count($reservations) }} reservation(s) in total</span>
    @else
      <h3>No active reservations</h3>
    @endif
  </div>
  @if((!$reservations->isEmpty()))
    <div style="overflow: auto; max-height: 400px">
      <table class="table table-hover table-condensed">
        <thead>
        <tr>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        @foreach($reservations as $reservation)
          <tr>
            <td><a href="{{ route('vehicle.show', ['id' => $reservation->vehicle->id]) }}">{{ $reservation->vehicle->name() }}</a></td>
            <td>{{ date('jS F Y', strtotime($reservation->start_date)) }}</td>
            <td>{{ date('jS F Y', strtotime($reservation->end_date)) }}</td>
            <td>
              <a style="width: 100%" href="{{ route('reservation.editForm', ['vehicle_id' => $reservation->vehicle->id, 'reservation_id' => $reservation->id]) }}"
                 class="btn btn-primary btn-sm" role="button" aria-pressed="true">Re-schedule
              </a>
              {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
              {{ Form::submit('Cancel', ['class' => 'btn btn-primary btn-sm', 'style' => 'width: 100%; margin-top: 5px;']) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif
</div>
