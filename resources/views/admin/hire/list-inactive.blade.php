<div class="panel panel-default">
  @if($inactiveHires->isNotEmpty())
  <div class="panel-heading">
    <h3>Past hires</h3>
    <span>{{ count($inactiveHires) }} hire(s) in total</span>
  </div>
  @else
    <div class="panel-body">
      <h3>No active hires</h3>
    </div>
  @endif
  @if($inactiveHires->isNotEmpty())
    <div class="scrollable-table">
      <table class="table table-condensed panel-table">
        <thead>
        <tr>
          <th class="first">ID</th>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inactiveHires->sortByDesc('end_date') as $inactiveHire)
          <tr>
            <td class="first">{{ $inactiveHire->name }}</td>
            <td>{{ $inactiveHire->vehicle->name() }}</td>
            <td>{{ date('j/M/Y', strtotime($inactiveHire->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($inactiveHire->end_date)) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>