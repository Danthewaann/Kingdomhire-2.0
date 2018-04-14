<h3>Vehicle list</h3>
<table class="table">
    <th>Vehicle</th>
    <th>Status</th>
    @foreach($vehicles as $vehicle)
        <tr>
            <td style="width: 250px;">{{ $vehicle->make }} {{ $vehicle->model }}</td>
            <td>{{ $vehicle->status }}</td>
        </tr>
    @endforeach
</table>
