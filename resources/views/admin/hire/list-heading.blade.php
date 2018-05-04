@if(!empty($vehicle))
  <div class="panel-heading">
    @if(!$vehicle->hires->isEmpty())
      <h3>Active hire</h3>
    @else
      <h3>No active hire</h3>
    @endif
  </div>
@else
  <div class="panel-heading">
    @if(!$hires->isEmpty())
      <h3>Active hires</h3>
    @else
      <h3>No active hires</h3>
    @endif
  </div>
@endif