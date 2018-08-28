@extends('layouts.admin-main')

@section('content')
@include('admin.vehicle-rate.delete-modal')
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 col-md-8 col-sm-8 col-xs-12">
      <div class="well">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 style="padding-left: 5px">Edit weekly rate</h3>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" action="{{ route('admin.weekly-rate.edit', ['rate' => $rate->name]) }}" method="post" id="weekly_rate_edit_form">
              @csrf
              @method('PATCH')
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label col-md-3">Name*</label>
                <div class="col-md-9">
                  <input id="name" type="text" class="form-control" name="name" value="{{ $rate->name }}" autocomplete="off">
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
                <label for="weekly_rate_min" class="control-label col-md-3">Minimum Rate*</label>
                <div class="col-md-9">
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                    <input id="weekly_rate_min" type="text" class="form-control" name="weekly_rate_min" value="{{ $rate->weekly_rate_min }}" autocomplete="off">
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
                <label for="weekly_rate_max" class="control-label col-md-3">Maximum Rate*</label>
                <div class="col-md-9">
                  <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                    <input id="weekly_rate_max" type="text" class="form-control" name="weekly_rate_max" value="{{ $rate->weekly_rate_max }}" autocomplete="off">
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
            </form>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-3">
                    <button type="submit" form="weekly_rate_edit_form" class="btn btn-info"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  </div>
                  <div class="col-md-4 col-md-offset-2">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#weekly-rate-{{ $rate->id }}-delete" style="float: right"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
