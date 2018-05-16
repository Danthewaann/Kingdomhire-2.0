<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$vehicle->getInactiveHires()->isEmpty())
      <h3>Past hires</h3>
    @else
      <h3>No past hires</h3>
    @endif
  </div>
  @if(!$vehicle->getInactiveHires()->isEmpty())
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
          </thead>
          @foreach($vehicle->getInactiveHires() as $hire)
            <tr>
              <td>{{ $hire->start_date }}</td>
              <td>{{ $hire->end_date }}</td>
              <td>
                <a href="{{ route('hire.edit', ['make' => $vehicle->make, 'model' => $vehicle->model, 'vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}"
                   class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  @endif
</div>