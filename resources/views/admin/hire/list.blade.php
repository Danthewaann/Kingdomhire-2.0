<div class="panel panel-default">
  @include('admin.hire.list-heading')
  @if(empty($vehicles) and !empty($vehicle))
    @if(!$vehicle->hires->isEmpty())
      <div class="panel-body">
        @include('admin.hire.list-table')
      </div>
    @endif
  @else
    @if(!$hires->isEmpty())
      <div class="panel-body">
        @include('admin.hire.list-table')
      </div>
    @endif
  @endif
</div>