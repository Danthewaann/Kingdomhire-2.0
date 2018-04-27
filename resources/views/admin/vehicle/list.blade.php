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
                </tr>
            </thead>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
                    <td>{{ $vehicle->type }}</td>
                    <td>{{ $vehicle->fuel_type }}</td>
                    <td>{{ $vehicle->gear_type }}</td>
                    <td>{{ $vehicle->seats }}</td>
                    @if(!empty($vehicle->rate))
                        <td>{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</td>
                    @else
                        <td>N/A</td>
                    @endif
                    <td>{{ $vehicle->status }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
