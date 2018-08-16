@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="col-md-4 col-sm-8 col-xs-12">
    <div class="well">
      <div class="row">
        <div class="col-md-12">
          <h3>Edit weekly rate</h3>
        </div>
        <form action="{{ route('vehicle-rate.edit', ['rate' => $rate->name]) }}" method="post" id="weekly_rate_edit_form">
          @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-12">
              <label for="name">Name*</label>
              <input id="name" type="text" class="form-control" name="name" value="{{ $rate->name }}" autocomplete="off">
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
                <input id="weekly_rate_min" type="text" class="form-control" name="weekly_rate_min" value="{{ $rate->weekly_rate_min }}" autocomplete="off">
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
                <input id="weekly_rate_max" type="text" class="form-control" name="weekly_rate_max" value="{{ $rate->weekly_rate_max }}" autocomplete="off">
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
        </form>
        {{ Form::open(['route' => ['vehicle-rate.delete', $rate->name], 'method' => 'delete', 'id' => 'weekly_rate_delete_form']) }}
        {{ Form::close() }}
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" form="weekly_rate_edit_form" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
              <button type="submit" form="weekly_rate_delete_form" class="btn btn-lg btn-primary" style="float: right"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
