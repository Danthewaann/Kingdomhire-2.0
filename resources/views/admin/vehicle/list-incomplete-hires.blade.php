@if(!$vehicle->getIncompleteHires()->isEmpty())
    <h3>Incomplete past hires</h3>
    <h5>{{ count($vehicle->getIncompleteHires()) }} hire(s) in total</h5>
@endif
@if(!$vehicle->getIncompleteHires()->isEmpty())
    <div class="scrollable-list" style="max-height: 420px">
        <table class="table table-condensed">
            <tr>
                <th>Hired By</th>
                <th>Rate</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            @foreach($vehicle->getIncompleteHires()->sortByDesc('end_date') as $hire)
                <tr>
                    <td>{{ $hire->hired_by }}</td>
                    <td>Not assigned</td>
                    <td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>
                    <td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endif