<div class="panel panel-default">
  @if(!$vehicle->getCompleteHires()->isEmpty())
  <div class="panel-heading">
    <h3>Past hires</h3>
    <h5>{{ count($vehicle->getCompleteHires()) }} hire(s) in total</h5>
  </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No past hires</h3>
    </div>
  @endif
  @if(!$vehicle->getCompleteHires()->isEmpty())
    <div class="scrollable-list" style="max-height: 229px">
      <table class="table table-condensed panel-table">
        <thead>
          <tr>
            <th class="first">Hired By</th>
            <th>Rate</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicle->getCompleteHires()->sortByDesc('end_date') as $hire)
            <tr>
              <td class="first">{{ $hire->hired_by }}</td>
              <td>£{{ $hire->rate }}</td>
              <td>{{ date('j/M/Y', strtotime($hire->start_date)) }}</td>
              <td>{{ date('j/M/Y', strtotime($hire->end_date)) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>