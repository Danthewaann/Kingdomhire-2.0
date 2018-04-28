<div class="panel panel-default">
    <div class="panel-heading">
        @if($vehicles->isEmpty())
            <h3>No vehicles present</h3>
        @else
            <h3>Active vehicles list</h3>
        @endif
    </div>
    @if(!$vehicles->isEmpty())
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vehicle</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach($vehicles as $vehicle)
                  @if($vehicle->is_active == true)
                    <tr>
                      <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
                      <td>{{ $vehicle->status }}</td>
                    </tr>
                  @endif
                @endforeach
            </table>
        </div>
    @endif
</div>
