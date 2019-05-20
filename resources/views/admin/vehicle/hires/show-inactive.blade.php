<div class="panel panel-default">
  @if(!$vehicle->getInactiveHires()->isEmpty())
  <div class="panel-heading">
    <h3>Past hires</h3>
    <h5>{{ count($vehicle->getInactiveHires()) }} hire(s) in total</h5>
  </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No past hires</h3>
    </div>
  @endif
  @if(!$vehicle->getInactiveHires()->isEmpty())
    <div class="scrollable-table" style="max-height: 229px">
      <table class="table table-condensed panel-table">
        <thead>
          <tr>
            <th class="first">ID</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vehicle->getInactiveHires()->sortByDesc('end_date') as $hire)
            <tr>
              <td class="first">{{ $hire->name }}</td>
              <td>{{ date('j/M/Y', strtotime($hire->start_date)) }}</td>
              <td>{{ date('j/M/Y', strtotime($hire->end_date)) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>