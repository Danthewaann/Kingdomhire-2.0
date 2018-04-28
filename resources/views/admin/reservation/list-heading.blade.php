@if(empty($vehicles))
  <div class="panel-heading">
    @if(!$vehicle->reservations->isEmpty())
      <h3>Active reservations</h3>
    @else
      <h3>No active reservations</h3>
    @endif
  </div>
@else
  <div class="panel-heading">
    @if(!$reservations->isEmpty())
      <h3>Active reservations</h3>
    @else
      <h3>No active reservations</h3>
    @endif
  </div>
@endif