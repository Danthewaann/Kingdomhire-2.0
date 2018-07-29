@if(!$vehicle->reservations->isEmpty())
  <h3>Current reservations</h3>
  <span>{{ count($vehicle->reservations) }} reservation(s) in total</span>
@else
  <h3>No current reservations</h3>
@endif
@if(!$vehicle->reservations->isEmpty())
  <table class="table table-condensed">
    <tr>
      <th style="width: 35%">Start Date</th>
      <th>End Date</th>
      <th></th>
    </tr>
  </table>
  <div style="overflow: auto; max-height: 420px">
    <table class="table table-condensed">
      <tbody>
        @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
          <tr>
            <td>{{ date('jS F Y', strtotime($reservation->start_date)) }}</td>
            <td>{{ date('jS F Y', strtotime($reservation->end_date)) }}</td>
            <td>
              <a style="width: 100%" href="{{ route('reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $reservation->id]) }}"
                 class="btn btn-info" role="button" aria-pressed="true">Re-schedule
              </a>
              {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
              {{ Form::submit('Cancel', ['class' => 'btn btn-info', 'style' => 'width: 100%; margin-top: 5px;']) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endif