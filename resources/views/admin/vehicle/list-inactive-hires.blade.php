<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$vehicle->getInactiveHires()->isEmpty())
      <h3>Past hires</h3>
      <span>{{ count($vehicle->getInactiveHires()) }} hire(s) in total</span>
    @else
      <h3>No past hires</h3>
    @endif
  </div>
  @if(!$vehicle->getInactiveHires()->isEmpty())
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm">
          <thead>
          <tr>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
          </thead>
          @foreach($vehicle->getInactiveHires()->sortByDesc('end_date') as $hire)
            <tr>
              <td>{{ $hire->start_date }}</td>
              <td>{{ $hire->end_date }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  @endif
</div>