<div class="panel panel-default">
  <div class="panel-heading panel-title-text">
    @if(!empty($vehicle->getActiveHire()))
      <h3>Active hire</h3>
    @else
      <h3>No active hire</h3>
    @endif
  </div>
    @if(!empty($vehicle->getActiveHire()))
      <table class="table table-hover table-condensed">
        <thead>
        <tr>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        <tr>
          <td>{{ date('jS F Y', strtotime($vehicle->getActiveHire()->start_date)) }}</td>
          <td>{{ date('jS F Y', strtotime($vehicle->getActiveHire()->end_date)) }}</td>
          <td>
            <a style="width: 100%" href="{{ route('hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $vehicle->getActiveHire()->id]) }}"
               class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
          </td>
        </tr>
      </table>
  @endif
</div>