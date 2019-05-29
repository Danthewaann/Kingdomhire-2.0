
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Create weekly rate</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" action="{{ route('admin.weekly-rates.store') }}" method="post">
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
      <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }}">
        <label for="weekly_rate_min" class="control-label col-sm-4">Minimum Rate*</label>
        <div class="col-sm-8">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
            <input type="text" class="form-control" id="weekly_rate_min" name="weekly_rate_min" value="{{ old('weekly_rate_min') }}" autocomplete="off" placeholder="Enter min rate">
          </div>
          @if( $errors->has('weekly_rate_min'))
            @include('admin.common.alert-danger', ['error' => $errors->first('weekly_rate_min')])
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('weekly_rate_max') ? ' has-error' : '' }}">
        <label for="weekly_rate_max" class="control-label col-sm-4">Maximum Rate*</label>
        <div class="col-sm-8">
          <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
            <input type="text" class="form-control" id="weekly_rate_max" name="weekly_rate_max" value="{{ old('weekly_rate_max') }}" autocomplete="off" placeholder="Enter max rate">
          </div>
          @if( $errors->has('weekly_rate_max'))
            @include('admin.common.alert-danger', ['error' => $errors->first('weekly_rate_max')])
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
