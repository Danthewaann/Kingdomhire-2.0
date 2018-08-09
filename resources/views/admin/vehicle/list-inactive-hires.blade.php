@if(!$vehicle->getCompleteHires()->isEmpty())
  <h3>Past hires</h3>
  <span>{{ count($vehicle->getCompleteHires()) }} hire(s) in total</span>
@else
  <h3>No past hires</h3>
@endif
@if(!$vehicle->getCompleteHires()->isEmpty())
  <div style="overflow: auto; max-height: 495px">
    <table class="table table-condensed">
      <tr>
        <th>Hired By</th>
        <th>Rate</th>
        <th>Start Date</th>
        <th>End Date</th>
      </tr>
      @foreach($vehicle->getCompleteHires()->sortByDesc('end_date') as $hire)
        <tr>
          <td>{{ $hire->hired_by }}</td>
          <td>£{{ $hire->rate }}</td>
          <td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>
          <td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>
        </tr>
      @endforeach
    </table>
  </div>
@endif