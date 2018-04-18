<h3>Current Vehicles list</h3>
<table class="table">
    <th>Vehicle</th>
    <th>Status</th>
    @foreach($vehicles as $vehicle)
        @if($vehicle->is_active == true)
        <tr>
            <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
            <td>{{ $vehicle->status }}</td>
            <td>
                <form action="{{ url('admin/deleteVehicle') }}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Discontinue</button>
                    <input type="hidden" value="{{ $vehicle->make }} {{ $vehicle->model }}" name="delete" />
                </form>
            </td>
            <td>
                <form action="{{ url('admin/logReservation') }}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Log Reservation</button>
                    <input type="hidden" value="{{ $vehicle->make }} {{ $vehicle->model }}" name="vehicle" />
                </form>
            </td>
            <td>
                <form action="{{ url('admin/logHire') }}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Log Hire</button>
                    <input type="hidden" value="{{ $vehicle->make }} {{ $vehicle->model }}" name="vehicle" />
                </form>
            </td>

        </tr>
        @endif
    @endforeach
</table>
