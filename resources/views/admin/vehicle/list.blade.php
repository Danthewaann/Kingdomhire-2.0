<h3>Vehicle list</h3>
<table class="table">
    <th>Vehicle</th>
    <th>Status</th>
    <th>Active</th>
    @foreach($vehicles as $vehicle)
        <tr>
            <td style="width: 250px;">{{ $vehicle->make }} {{ $vehicle->model }}</td>
            <td>{{ $vehicle->status }}</td>
            @if($vehicle->is_active == true)
                <td>Yes</td>
            @else
                <td>No</td>
            @endif
        </tr>
    @endforeach
</table>
