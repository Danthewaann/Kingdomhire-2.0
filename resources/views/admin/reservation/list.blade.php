<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$reservations->isEmpty())
      <h3>Active reservations</h3>
      <span>{{ count($reservations) }} reservation(s) in total</span>
    @else
      <h3>No active reservations</h3>
    @endif
  </div>
  @if((!$reservations->isEmpty()))
    <div style="overflow: auto; max-height: 555px">
      <div class="table-responsive">
        <table class="table table-hover table-sm">
          <thead>
          <tr>
            <th style="padding-left: 15px">Vehicle</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
          </thead>
          @foreach($reservations as $reservation)
            <tr>
              <td style="padding-left: 15px"><a href="{{ route('vehicle.show', ['id' => $reservation->vehicle->id]) }}">{{ $reservation->vehicle->name() }}</a></td>
              <td>{{ $reservation->start_date }}</td>
              <td>{{ $reservation->end_date }}</td>
              <td style="padding-right: 15px">
                <span style="width: 100%">
                  <a style="width: 100%" href="{{ route('reservation.editForm', ['vehicle_id' => $reservation->vehicle->id, 'reservation_id' => $reservation->id]) }}"
                     class="btn btn-primary" role="button" aria-pressed="true">Re-schedule
                  </a>
                  {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                  {{ Form::submit('Cancel', ['class' => 'btn btn-primary', 'style' => 'width: 100%; margin-top: 5px;']) }}
                  {{ Form::close() }}
                </span>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  @endif
</div>
