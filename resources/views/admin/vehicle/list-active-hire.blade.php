<div class="panel panel-default">
  <div class="panel-heading">
    @if(!empty($vehicle->getActiveHire()))
      <h3>Active hire</h3>
    @else
      <h3>No active hire</h3>
    @endif
  </div>
    @if(!empty($vehicle->getActiveHire()))
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
          <tr>
            <td>{{ $vehicle->getActiveHire()->start_date }}</td>
            <td>{{ $vehicle->getActiveHire()->end_date }}</td>
            <td>
              <a href="{{ route('hire.edit', ['make' => $vehicle->make, 'model' => $vehicle->model, 'vehicle_id' => $vehicle->id, 'hire_id' => $vehicle->getActiveHire()->id]) }}"
                 class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  @endif
</div>