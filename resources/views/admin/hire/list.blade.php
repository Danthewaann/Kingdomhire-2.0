<div class="panel panel-default">
  <div class="panel-heading"><h3>Current Hires</h3></div>
  <div class="panel-body">
    <table class="table">
      <thead>
        <tr>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
      </thead>
        @foreach($vehicles as $vehicle)
            @foreach($vehicle->hires as $hire)
                <tr>
                    <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
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
</div>
