<h3>Vehicle price rates</h3>
<table class="table">
  <tr>
    <th>Name</th>
    <th>Weekly Min Rate</th>
    <th>Weekly Max Rate</th>
    <th></th>
    <th></th>
  </tr>
  @foreach($rates as $rate)
    <tr>
      <td>{{ $rate->name }}</td>
      <td>£{{ $rate->weekly_rate_min }}</td>
      <td>£{{ $rate->weekly_rate_max }}</td>
      <td>
        <a href="{{ route('vehicle-rate.edit', ['rate' => $rate->name]) }}"
           class="btn btn-info" role="button" aria-pressed="true">Edit</a>
      </td>
      <td>
        {{ Form::open(['route' => ['vehicle-rate.delete', $rate->name], 'method' => 'delete']) }}
        {{ Form::submit('Delete', ['class' => 'btn btn-info']) }}
        {{ Form::close() }}
      </td>
    </tr>
  @endforeach
</table>