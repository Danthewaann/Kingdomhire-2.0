<h3>Current Reservations</h3>
<table class="table">
    <th>Vehicle</th>
    <th>Start Date</th>
    <th>End Date</th>
    @foreach($vehicles as $vehicle)
        @foreach($vehicle->reservations as $reservation)
            <tr>
                <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
                <td>{{ $reservation->start_date }}</td>
                <td>{{ $reservation->end_date }}</td>
                <td>
                  <form action="{{ url('admin/deleteReservation') }}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Cancel Reservation</button>
                    <input type="hidden" value="{{ $reservation->id }}" name="reservation" />
                  </form>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
