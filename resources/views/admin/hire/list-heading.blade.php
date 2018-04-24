@if(empty($vehicles))
  <div class="panel-heading">
    @if(!$vehicle->hires->isEmpty())
      <h3>Current hires</h3>
    @else
      <h3>No current hires</h3>
    @endif
  </div>
@else
  <div class="panel-heading">
    @if(!$hires->isEmpty())
      <h3>Current hires</h3>
    @else
      <h3>No current hires</h3>
    @endif
  </div>
@endif