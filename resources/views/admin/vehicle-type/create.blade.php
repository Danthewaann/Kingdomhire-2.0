<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Create vehicle type</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" action="{{ route('admin.vehicle-types.store') }}" method="post">
      @csrf
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="control-label col-sm-4">Name*</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter name">
          @if( $errors->has('name'))
            @include('admin.common.alert-danger', ['error' => $errors->first('name')])
          @endif
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-4 col-sm-offset-4">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Create</button>
        </div>
      </div>
    </form>
  </div>
</div>
