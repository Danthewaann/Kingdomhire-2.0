{{--<div class="panel panel-default">--}}
  {{--<div class="panel-heading panel-title-text"><h3>Vehicle price rates</h3></div>--}}
<h3>Vehicle price rates</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Engine Size</th>
          <th>Weekly Min Rate</th>
          <th>Weekly Max Rate</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      @foreach($rates as $rate)
        <tr>
          <td style="padding-left: 15px">{{ $rate->engine_size }}</td>
          <td>£{{ $rate->weekly_rate_min }}</td>
          <td>£{{ $rate->weekly_rate_max }}</td>
          <td>
            <a href="{{ route('vehicle-rate.edit', ['rate' => $rate->engine_size]) }}"
               class="btn btn-info" role="button" aria-pressed="true">Edit</a>
          </td>
          <td>
            {{ Form::open(['route' => ['vehicle-rate.delete', $rate->engine_size], 'method' => 'delete']) }}
            {{ Form::submit('Delete', ['class' => 'btn btn-info']) }}
            {{ Form::close() }}
          </td>
        </tr>
      @endforeach
    </table>
{{--</div>--}}