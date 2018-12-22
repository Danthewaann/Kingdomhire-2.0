<div class="modal fade" id="vehicle-gear-type-{{ $vehicleGearType->id }}-delete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete gear type {{ $vehicleGearType->name }}</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this gear type?
      </div>
      {{ Form::open(['route' => ['admin.vehicle-gear-types.destroy', $vehicleGearType->name],
                                 'method' => 'delete', 'id' => 'vehicle-gear-type-'.$vehicleGearType->id.'-delete-form']) }}
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;No</button>
        <button type="submit" form="vehicle-gear-type-{{ $vehicleGearType->id }}-delete-form" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Yes</button>
      </div>
    </div>
  </div>
</div>