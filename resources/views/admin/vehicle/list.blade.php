<div class="panel panel-default">
    <div class="panel-heading"><h3>Current vehicles list</h3></div>
    <div class="panel-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Fuel Type</th>
                    <th>Gear Type</th>
                    <th>Seats</th>
                    <th>Weekly Price Rate</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->fuel_type }}</td>
                    <td>{{ $vehicle->gear_type }}</td>
                    <td>{{ $vehicle->seats }}</td>
                    <td>£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }}</td>
                    <td>{{ $vehicle->status }}</td>
                    <td><a href="{{ route('reservation.form', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">Log Reservation</a></td>
                    <td>{{ Form::open(['route' => ['vehicle.discontinue', $vehicle->make, $vehicle->model], 'method' => 'delete']) }}
                        {{ Form::submit('Discontinue', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>