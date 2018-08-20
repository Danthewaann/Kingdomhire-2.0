@if($vehicle->getIncompleteHires()->isNotEmpty())
    <h3>Incomplete past hires</h3>
    <h5>{{ count($vehicle->getIncompleteHires()) }} hire(s) in total</h5>
@endif
@if($vehicle->getIncompleteHires()->isNotEmpty())
    <div class="scrollable-list" style="max-height: 420px">
        <table class="table table-condensed">
            <tr>
                <th>Hired By</th>
                <th>Rate</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
            </tr>
            @foreach($vehicle->getIncompleteHires()->sortByDesc('end_date') as $hire)
                <tr>
                    <td>{{ $hire->hired_by }}</td>
                    <td>N/A</td>
                    <td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>
                    <td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>
                    <td>
                        <div class="btn-group btn-group-justified" style="width: inherit">
                            <div class="btn-group">
                                <a href="{{ route('admin.vehicle.hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}"
                                   class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endif