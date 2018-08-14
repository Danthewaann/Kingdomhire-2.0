@if(!empty($vehicle->getActiveHire()))
  <h3>Active hire</h3>
@else
  <h3>No active hire</h3>
@endif
@if(!empty($vehicle->getActiveHire()))
  <div class="scrollable-list" style="max-height: 570px">
    <table class="table table-condensed">
      <tr>
        <th>Hired By</th>
        <th>Rate</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th></th>
      </tr>
      <tr>
        <td>{{ $vehicle->getActiveHire()->hired_by }}</td>
        <td>
          @if($vehicle->getActiveHire()->rate != null)
            £{{ $vehicle->getActiveHire()->rate }}
          @else
            Not assigned
          @endif
        </td>
        <td>{{ date('jS F Y', strtotime($vehicle->getActiveHire()->start_date)) }}</td>
        <td>{{ date('jS F Y', strtotime($vehicle->getActiveHire()->end_date)) }}</td>
        <td>
          <div class="btn-group-lg" style="float: right">
            <a href="{{ route('hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $vehicle->getActiveHire()->id]) }}"
               class="btn btn-lg btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
          </div>
        </td>
      </tr>
    </table>
  </div>
@endif