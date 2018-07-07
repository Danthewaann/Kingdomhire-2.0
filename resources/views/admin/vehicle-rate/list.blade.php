<div class="panel panel-default">
  <div class="panel-heading panel-title-text"><h3>Vehicle price rates</h3></div>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="padding-left: 15px">Engine Size</th>
            <th>Weekly Minimum Rate</th>
            <th>Weekly Maximum Rate</th>
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
                 class="btn btn-primary" role="button" aria-pressed="true">Edit</a>
            </td>
            <td>
              {{ Form::open(['route' => ['vehicle-rate.delete', $rate->engine_size], 'method' => 'delete']) }}
              {{ Form::submit('Delete', ['class' => 'btn btn-primary']) }}
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
</div>