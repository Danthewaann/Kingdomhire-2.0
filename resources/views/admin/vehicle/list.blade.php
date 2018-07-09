<div class="panel panel-default">
    <div class="panel-heading panel-title-text">
        @if($vehicles->isEmpty())
            <h3>No vehicles present</h3>
        @else
            <h3>Active vehicles</h3>
            <span>{{ count($vehicles) }} vehicle(s) in total</span>
        @endif
    </div>
    @if(!$vehicles->isEmpty())
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach($vehicles as $vehicle)
              @if($vehicle->is_active == true)
                <tr>
                  <td><a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">{{ $vehicle->name() }}</a></td>
                  <td>{{ $vehicle->status }}</td>
                </tr>
              @endif
            @endforeach
        </table>
    @endif
</div>
