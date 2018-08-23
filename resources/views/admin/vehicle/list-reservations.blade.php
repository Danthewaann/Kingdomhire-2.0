<div class="panel panel-default">
  @if(!$vehicle->reservations->isEmpty())
    <div class="panel-heading">
      <h3>Reservations</h3>
      <h5>{{ count($vehicle->reservations) }} reservation(s) in total</h5>
    </div>
  @else
    <div class="panel-body">
      <h3>No reservations</h3>
    </div>
  @endif
  @if(!$vehicle->reservations->isEmpty())
  <div class="scrollable-list" style="max-height: 440px">
  {{--<div class="scrollable-list" style="max-height: 278px">--}}
    <table class="table table-condensed panel-table">
      <thead>
        <tr>
          <th class="first">Made By</th>
          <th>Rate</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
          <tr>
            <td class="first">{{ $reservation->made_by }}</td>
            <td>
              @if($reservation->rate != null)
                £{{ $reservation->rate }}
              @else
                N/A
              @endif
            </td>
            <td>{{ date('j/M/Y', strtotime($reservation->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($reservation->end_date)) }}</td>
            <td>
              <div class="btn-group btn-group-vertical" style="width: 100%">
                <div class="btn-group">
                  <a href="{{ route('admin.vehicle.reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $reservation->id]) }}"
                     class="btn btn-info" style="width: 100%" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit
                  </a>
                </div>
                <div class="btn-group">
                  {{ Form::open(['route' => ['admin.vehicle.reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                  <button type="submit" style="width: 100%" class="btn btn-info"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Cancel</button>
                  {{ Form::close() }}
                </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>