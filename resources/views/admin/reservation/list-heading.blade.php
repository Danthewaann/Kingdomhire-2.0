@if(empty($vehicles))
  <div class="panel-heading">
    @if(!$vehicle->reservations->isEmpty())
      <h3>Current reservations</h3>
    @else
      <h3>No current reservations</h3>
    @endif
    <a href="{{ route('reservation.form', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">Log Reservation</a>
  </div>
@else
  <div class="panel-heading">
    @if(!$reservations->isEmpty())
      <h3>Current reservations</h3>
    @else
      <h3>No current reservations</h3>
    @endif
  </div>
@endif