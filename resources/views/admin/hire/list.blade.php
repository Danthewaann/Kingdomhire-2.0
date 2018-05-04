<div class="panel panel-default">
  @include('admin.hire.list-heading')
    @if((!empty($hires) and count($hires) > 0) or ( !empty($vehicle) and count($vehicle->hires) > 0))
      <div class="panel-body">
        @include('admin.hire.list-table')
      </div>
    @endif
</div>