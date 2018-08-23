<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$vehicle->getCompleteHires()->isEmpty())
      <h3>Past hires</h3>
      <h5>{{ count($vehicle->getCompleteHires()) }} hire(s) in total</h5>
    @else
      <h3>No past hires</h3>
    @endif
  </div>
  @if(!$vehicle->getCompleteHires()->isEmpty())
    <div class="scrollable-list" style="max-height: 490px">
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