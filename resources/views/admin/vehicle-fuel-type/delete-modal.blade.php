<div class="modal fade" id="vehicle-fuel-type-{{ $vehicleFuelType->id }}-delete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete fuel type {{ $vehicleFuelType->name }}</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this fuel type?
      </div>
      {{ Form::open(['route' => ['admin.vehicle-fuel-types.destroy', $vehicleFuelType->name],
                                 'method' => 'delete', 'id' => 'vehicle-fuel-type-'.$vehicleFuelType->id.'-delete-form']) }}
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;No</button>
        <button type="submit" form="vehicle-fuel-type-{{ $vehicleFuelType->id }}-delete-form" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Yes</button>
      </div>
    </div>
  </div>
</div>