<div class="panel panel-default">
  @if($vehicle->hasActiveHire())
  <div class="panel-heading">
    <h3>Active hire</h3>
  </div>
  @else
  <div class="panel-body">
    <h3 style="margin-left: -5px">No active hire</h3>
  </div>
  @endif
  @if($vehicle->hasActiveHire())
    <div class="scrollable-list" style="max-height: 570px">
      <table class="table table-condensed panel-table">
        <thead>
          <tr>
            <th class="first">Hired By</th>
            <th>Rate</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="first">{{ $vehicle->getActiveHire()->hired_by }}</td>
            <td>
              @if($vehicle->getActiveHire()->rate != null)
                £{{ $vehicle->getActiveHire()->rate }}
              @else
                N/A
              @endif
            </td>
            <td>{{ date('j/M/Y', strtotime($vehicle->getActiveHire()->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($vehicle->getActiveHire()->end_date)) }}</td>
            <td>
              <div class="btn-group btn-group-justified" style="width: inherit">
                <div class="btn-group">
                  <a href="{{ route('admin.vehicle.hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $vehicle->getActiveHire()->id]) }}"
                     class="btn btn-info" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  @endif
</div>