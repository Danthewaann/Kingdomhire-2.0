@if(!$vehicle->reservations->isEmpty())
  <h3>Reservations</h3>
  <span>{{ count($vehicle->reservations) }} reservation(s) in total</span>
@else
  <h3>No reservations</h3>
@endif
@if(!$vehicle->reservations->isEmpty())
  <div style="overflow-y: auto; max-height: 570px">
    <table class="table table-condensed">
      <tr>
        <th>Made By</th>
        <th>Rate</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th></th>
      </tr>
      @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
        <tr>
          <td>{{ $reservation->made_by }}</td>
          <td>
            @if($reservation->rate != null)
              £{{ $reservation->rate }}
            @else
              Not assigned
            @endif
          </td>
          <td>{{ date('jS F Y', strtotime($reservation->start_date)) }}</td>
          <td>{{ date('jS F Y', strtotime($reservation->end_date)) }}</td>
          <td>
            <a style="width: 100%" href="{{ route('reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $reservation->id]) }}"
               class="btn btn-primary" role="button" aria-pressed="true">Edit
            </a>
            {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
            {{ Form::submit('Cancel', ['class' => 'btn btn-primary', 'style' => 'width: 100%; margin-top: 5px;']) }}
            {{ Form::close() }}
          </td>
        </tr>
        @endforeach
    </table>
  </div>
@endif