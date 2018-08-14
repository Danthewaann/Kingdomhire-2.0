@if(!$vehicle->reservations->isEmpty())
  <h3>Reservations</h3>
  <h5>{{ count($vehicle->reservations) }} reservation(s) in total</h5>
@else
  <h3>No reservations</h3>
@endif
@if(!$vehicle->reservations->isEmpty())
  <div class="scrollable-list" style="max-height: 590px">
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
            <div class="btn-group-vertical btn-group-lg">
              <a href="{{ route('reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $reservation->id]) }}"
                 class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit
              </a>
              {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Cancel</button>
              {{--{{ Form::submit('Cancel', ['class' => 'btn btn-primary', 'style' => 'width: 100%; margin-top: 5px;']) }}--}}
              {{ Form::close() }}
            </div>
          </td>
        </tr>
        @endforeach
    </table>
  </div>
@endif