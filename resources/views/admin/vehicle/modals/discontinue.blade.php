<div class="modal fade" id="vehicle-{{ $vehicle->id }}-discontinue" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Discontinue {{ $vehicle->name() }}</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to discontinue this vehicle?
      </div>
      {{ Form::open(['route' => ['admin.vehicles.discontinue', $vehicle->slug], 'method' => 'patch', 'id' => 'vehicle-'.$vehicle->id.'-discontinue-form']) }}
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;No</button>
        <button type="submit" form="vehicle-{{ $vehicle->id }}-discontinue-form" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Yes</button>
      </div>
    </div>
  </div>
</div>