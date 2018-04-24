<div class="panel panel-default">
  @include('admin.reservation.list-heading')
  @if(empty($vehicles))
    @if(!$vehicle->reservations->isEmpty())
      <div class="panel-body">
        @include('admin.reservation.list-table')
      </div>
    @endif
  @else
    @if(!$reservations->isEmpty())
      <div class="panel-body">
        @include('admin.reservation.list-table')
      </div>
    @endif
  @endif
</div>
