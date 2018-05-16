<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$hires->isEmpty())
      <h3>Hires</h3>
    @else
      <h3>No hires logged</h3>
    @endif
  </div>
  @if((!$hires->isEmpty()))
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          <th>Vehicle</th>
          <th>Is Active</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        @foreach($hires as $hire)
          <tr>
            <td><a href="{{ route('vehicle.show', ['make' => $hire->vehicle->make, 'model' => $hire->vehicle->model, 'id' => $hire->vehicle->id]) }}">{{ $hire->vehicle->name() }} </a></td>
            @if($hire->is_active == true)
              <td>Yes</td>
            @else
              <td>No</td>
            @endif
            <td>{{ $hire->start_date }}</td>
            <td>{{ $hire->end_date }}</td>
            <td>
              @if($hire->is_active == true)
                <a href="{{ route('hire.edit', ['make' => $hire->vehicle->make, 'model' => $hire->vehicle->model, 'vehicle_id' => $hire->vehicle->id, 'hire_id' => $hire->id]) }}"
                   class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
              @endif
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
  @endif
</div>