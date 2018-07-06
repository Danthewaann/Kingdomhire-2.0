<div class="panel panel-default">
    <div class="panel-heading">
        @if($vehicles->isEmpty())
            <h3>No vehicles present</h3>
        @else
            <h3>Active vehicles</h3>
            <span>{{ count($vehicles) }} vehicle(s) in total</span>
        @endif
    </div>
    @if(!$vehicles->isEmpty())
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead>
                <tr>
                    <th style="padding-left: 15px">Vehicle</th>
                    <th>Status</th>
                </tr>
            </thead>
            @foreach($vehicles as $vehicle)
              @if($vehicle->is_active == true)
                <tr>
                  <td style="padding-left: 15px"><a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">{{ $vehicle->name() }}</a></td>
                  <td style="padding-right: 15px">{{ $vehicle->status }}</td>
                </tr>
              @endif
            @endforeach
        </table>
      </div>
    @endif
</div>
