<div class="panel panel-default">
  <div class="panel-heading panel-title-text">
    @if(!$vehicle->reservations->isEmpty())
      <h3>Current reservations</h3>
      <span>{{ count($vehicle->reservations) }} reservation(s) in total</span>
    @else
      <h3>No current reservations</h3>
    @endif
  </div>
  @if(!$vehicle->reservations->isEmpty())
    <div style="overflow: auto; max-height: 420px">
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
            <tr>
              <td>{{ date('jS F Y', strtotime($reservation->start_date)) }}</td>
              <td>{{ date('jS F Y', strtotime($reservation->end_date)) }}</td>
              <td>
                <a style="width: 100%" href="{{ route('reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $reservation->id]) }}"
                   class="btn btn-primary" role="button" aria-pressed="true">Re-schedule
                </a>
                {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                {{ Form::submit('Cancel', ['class' => 'btn btn-primary', 'style' => 'width: 100%; margin-top: 5px;']) }}
                {{ Form::close() }}
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>