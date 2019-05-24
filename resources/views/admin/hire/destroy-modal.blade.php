<div class="modal fade" id="hire-{{ $hire->name }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Hire</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this hire?
        <ul>
          <li>ID = {{ $hire->name }}</li>
          <li>Start Date = {{ date('j/M/Y', strtotime($hire->start_date)) }}</li>
          <li>End Date = {{ date('j/M/Y', strtotime($hire->end_date)) }}</li>
        </ul>
      </div>
      {{ Form::open(['route' => ['admin.hires.destroy', $hire->name], 'method' => 'delete', 'id' => 'hire-'.$hire->name.'-cancel-form']) }}
      {{ Form::close() }}
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;No</button>
        <button type="submit" form="hire-{{ $hire->name }}-cancel-form" class="btn btn-danger"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Yes</button>
      </div>
    </div>
  </div>
</div>