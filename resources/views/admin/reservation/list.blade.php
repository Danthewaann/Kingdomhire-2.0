<div class="panel panel-default">
  <div class="panel-heading">
  @if(!empty($vehicle))
    @if(!$vehicle->reservations->isEmpty())
      <h3>Active reservations</h3>
    @else
      <h3>No active reservations</h3>
    @endif
  @else
    @if(!$reservations->isEmpty())
      <h3>Active reservations</h3>
    @else
      <h3>No active reservations</h3>
    @endif
  @endif
  </div>
  @if((!empty($reservations) and count($reservations) > 0) or ( !empty($vehicle) and count($vehicle->reservations) > 0))
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            @if(!empty($vehicles) or !empty($reservations))
              <th>Vehicle</th>
            @endif
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
            <th></th>
          </tr>
          </thead>
          @include('admin.reservation.list-table-row')
        </table>
      </div>
    </div>
  @endif
</div>
