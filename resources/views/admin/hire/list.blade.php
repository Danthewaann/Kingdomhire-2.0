<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$hires->isEmpty())
      <h3>Current hires</h3>
    @else
      <h3>No current hires</h3>
    @endif
  </div>
  @if(!$hires->isEmpty())
    <div class="panel-body">
      <table class="table">
        <thead>
          <tr>
            @if($vehicles->count() > 1)
              <th>Vehicle</th>
            @endif
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </thead>
          @foreach($vehicles as $vehicle)
            @foreach($vehicle->hires as $hire)
              <tr>
                @if($vehicles->count() > 1)
                  <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
                @endif
                <td>{{ $hire->start_date }}</td>
                <td>{{ $hire->end_date }}</td>
                <td>{{ Form::open(['route' => ['hire.cancel', $hire->id], 'method' => 'delete']) }}
                  {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
                  {{ Form::close() }}
                </td>
              </tr>
            @endforeach
          @endforeach
      </table>
    </div>
  @endif
</div>
