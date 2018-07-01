<div class="panel panel-default">
    <div class="panel-heading">
        @if($vehicles->isEmpty())
            <h3>No vehicles present</h3>
        @else
            <h3>Active vehicles</h3>
        @endif
    </div>
    @if(!$vehicles->isEmpty())
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm">
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
          </div>
        </div>
    @endif
</div>
