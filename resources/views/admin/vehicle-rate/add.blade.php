@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 col-sm-8 col-xs-12">
      <div class="well">
        <div class="row">
          <div class="col-md-12">
            <h3>Add a weekly rate</h3>
          </div>
          <form action="{{ route('admin.weekly-rate.add') }}" method="post">
            @csrf
            <div class="form-row">
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-12">
                <label for="name">Name*</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter name">
                @if( $errors->has('name'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('name') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-row">
              <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }} col-md-12">
                <label for="weekly_rate_min">Weekly Rate Minimum*</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                  <input type="text" class="form-control" id="weekly_rate_min" name="weekly_rate_min" value="{{ old('weekly_rate_min') }}" autocomplete="off" placeholder="Enter min rate">
                </div>
                @if( $errors->has('weekly_rate_min'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('weekly_rate_min') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-row">
              <div class="form-group{{ $errors->has('weekly_rate_max') ? ' has-error' : '' }} col-md-12">
                <label for="weekly_rate_max">Weekly Rate Maximum*</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                  <input type="text" class="form-control" id="weekly_rate_max" name="weekly_rate_max" value="{{ old('weekly_rate_max') }}" autocomplete="off" placeholder="Enter max rate">
                </div>
                @if( $errors->has('weekly_rate_max'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('weekly_rate_max') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-row">
              <div class="col-xs-12">
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
