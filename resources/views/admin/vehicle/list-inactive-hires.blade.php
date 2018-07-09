<div class="panel panel-default">
  <div class="panel-heading panel-title-text">
    @if(!$vehicle->getInactiveHires()->isEmpty())
      <h3>Past hires</h3>
      <span>{{ count($vehicle->getInactiveHires()) }} hire(s) in total</span>
    @else
      <h3>No past hires</h3>
    @endif
  </div>
  @if(!$vehicle->getInactiveHires()->isEmpty())
    <div style="overflow: auto; max-height: 400px">
      <table class="table table-bordered table-hover table-condensed">
        <thead>
        <tr>
          <th>Start Date</th>
          <th>End Date</th>
        </tr>
        </thead>
        @foreach($vehicle->getInactiveHires()->sortByDesc('end_date') as $hire)
          <tr>
            <td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>
            <td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif
</div>