<div class="panel panel-default">
  @if($vehicle->getIncompleteHires()->isNotEmpty())
    <div class="panel-heading">
      <h3>Incomplete past hires</h3>
      <h5>{{ count($vehicle->getIncompleteHires()) }} hire(s) in total</h5>
    </div>
  @endif
  @if($vehicle->getIncompleteHires()->isNotEmpty())
    <div class="scrollable-list" style="max-height: 420px">
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
        @foreach($vehicle->getIncompleteHires()->sortByDesc('end_date') as $hire)
          <tr>
            <td class="first">{{ $hire->hired_by }}</td>
            <td>N/A</td>
            <td>{{ date('j/M/Y', strtotime($hire->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($hire->end_date)) }}</td>
            <td>
              <div class="btn-group btn-group-justified" style="width: inherit">
                <div class="btn-group">
                  <a href="{{ route('admin.vehicle.hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}"
                     class="btn btn-info" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>