<h3>Current Hires</h3>
<table class="table">
    <th>Hire Id</th>
    <th>Vehicle</th>
    <th>Start Date</th>
    <th>End Date</th>
    @foreach($vehicles as $vehicle)
        @foreach($vehicle->hires as $hire)
            <tr>
                <td>{{ $hire->id }}</td>
                <td>{{ $vehicle->make }} {{ $vehicle->model }}</td>
                <td>{{ $hire->start_date }}</td>
                <td>{{ $hire->end_date }}</td>
                <td>
                  <form action="{{ url('admin/deleteHire') }}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Cancel Hire</button>
                    <input type="hidden" value="{{ $hire->id }}" name="hire" />
                  </form>
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
