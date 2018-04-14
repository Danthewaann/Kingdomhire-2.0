<h3>Reservations</h3>
<table class="table">
    <th>Reservation Id</th>
    <th>Vehicle</th>
    <th>Start Date</th>
    <th>End Date</th>
    @foreach($vehicles as $vehicle)
        @foreach($vehicle->reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
                <td>{{ $reservation->start_date }}</td>
                <td>{{ $reservation->end_date }}</td>
            </tr>
        @endforeach
    @endforeach
</table>
