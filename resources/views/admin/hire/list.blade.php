<div class="panel panel-default">
  <div class="panel-heading">
  @if(!empty($vehicle))
    @if(!$vehicle->hires->isEmpty())
      <h3>Active hire</h3>
    @else
      <h3>No active hire</h3>
    @endif
  @else
    @if(!$hires->isEmpty())
      <h3>Active hires</h3>
    @else
      <h3>No active hires</h3>
    @endif
  @endif
  </div>
  @if((!empty($hires) and count($hires) > 0) or ( !empty($vehicle) and count($vehicle->hires) > 0))
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
        <tr>
          @if(!empty($hires))
            <th>Vehicle</th>
            <th>Is Active</th>
          @endif
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        @include('admin.hire.list-table-row')
      </table>
    </div>
  </div>
  @endif
</div>