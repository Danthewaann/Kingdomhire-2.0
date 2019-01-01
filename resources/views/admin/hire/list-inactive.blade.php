<div class="panel panel-default">
  @if(!$inactiveHires->isEmpty())
  <div class="panel-heading">
    <h3>Past hires</h3>
    <span>{{ count($inactiveHires) }} hire(s) in total</span>
  </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No active hires</h3>
    </div>
  @endif
  @if($inactiveHires->count() > 0)
    <div class="scrollable-table" style="max-height: 655px">
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
        @foreach($inactiveHires as $activeHire)
          <tr>
            <td class="first">{{ $activeHire->name }}</td>
            <td>{{ $activeHire->vehicle->name() }}</td>
            <td>{{ date('j/M/Y', strtotime($activeHire->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($activeHire->end_date)) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>