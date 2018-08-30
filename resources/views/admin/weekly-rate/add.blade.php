@extends('layouts.admin-main')

@section('content')
<div class="col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="well">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 style="padding-left: 5px">Add a weekly rate</h3>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" action="{{ route('admin.weekly-rates.store') }}" method="post">
            @csrf
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="control-label col-sm-4">Name*</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter name">
                @if( $errors->has('name'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('name') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }}">
              <label for="weekly_rate_min" class="control-label col-sm-4">Minimum Rate*</label>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                  <input type="text" class="form-control" id="weekly_rate_min" name="weekly_rate_min" value="{{ old('weekly_rate_min') }}" autocomplete="off" placeholder="Enter min rate">
                </div>
                @if( $errors->has('weekly_rate_min'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('weekly_rate_min') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('weekly_rate_max') ? ' has-error' : '' }}">
              <label for="weekly_rate_max" class="control-label col-sm-4">Maximum Rate*</label>
              <div class="col-sm-6">
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                  <input type="text" class="form-control" id="weekly_rate_max" name="weekly_rate_max" value="{{ old('weekly_rate_max') }}" autocomplete="off" placeholder="Enter max rate">
                </div>
                @if( $errors->has('weekly_rate_max'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('weekly_rate_max') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-4 col-sm-offset-4">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Weekly Rate</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
