<div class="panel panel-default">
  @if($reservations->isNotEmpty())
    <div class="panel-heading">
      <h3>Reservations</h3>
      <h5>{{ count($reservations) }} reservation(s) in total</h5>
    </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No reservations</h3>
    </div>
  @endif
  @if($reservations->isNotEmpty())
    <div class="scrollable-table">
      <table class="table table-condensed panel-table">
        <thead>
        <tr>
          <th class="first">ID</th>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations->sortBy('end_date') as $reservation)
          @include('admin.reservation.destroy-modal')
          <tr>
            <td class="first">{{ $reservation->name ? $reservation->name : 'N/A'  }}</td>
            <td>{{ $reservation->vehicle->name() }}</td>
            <td>{{ date('j/M/Y', strtotime($reservation->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($reservation->end_date)) }}</td>
            <td>
              <div class="btn-group btn-group-vertical" style="width: 100%">
                <div class="btn-group">
                  <a href="{{ route('admin.vehicles.show', ['vehicle' => $reservation->vehicle->slug]) }}"
                     class="btn btn-primary" style="width: 100%" role="button" aria-pressed="true"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;&nbsp;Vehicle
                  </a>
                </div>
                <div class="btn-group">
                  <a href="{{ route('admin.reservations.edit', ['reservation' => $reservation->name]) }}"
                     class="btn btn-primary" style="width: 100%" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit
                  </a>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reservation-{{ $reservation->name }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Cancel</button>
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