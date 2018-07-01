<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$inactiveHires->isEmpty())
      <h3>Past hires</h3>
      <span>{{ count($inactiveHires) }} hire(s) in total</span>
    @else
      <h3>No past hires</h3>
    @endif
  </div>
  @if((!$inactiveHires->isEmpty()))
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-sm">
        <thead>
        <tr>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
        </tr>
        </thead>
        @foreach($inactiveHires as $hire)
          <tr>
            <td><a href="{{ route('vehicle.show', ['make' => $hire->vehicle->make, 'model' => $hire->vehicle->model, 'id' => $hire->vehicle->id]) }}">{{ $hire->vehicle->name() }} </a></td>
            <td>{{ $hire->start_date }}</td>
            <td>{{ $hire->end_date }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  @endif
</div>