@extends('layouts.admin-main')

@section('content')
<div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Edit weekly rate</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.weekly-rates.update', ['weekly_rate' => $rate->slug]) }}" method="post" id="weekly_rate_edit_form">
          @csrf
          @method('PATCH')
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label col-sm-4">Name*</label>
            <div class="col-sm-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $rate->name }}" autocomplete="off">
              @if( $errors->has('name'))
                @include('admin.common.alert-danger', ['error' => $errors->first('name')])
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }}">
            <label for="weekly_rate_min" class="control-label col-sm-4">Minimum Rate*</label>
            <div class="col-sm-6">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                <input id="weekly_rate_min" type="text" class="form-control" name="weekly_rate_min" value="{{ $rate->weekly_rate_min }}" autocomplete="off">
              </div>
              @if( $errors->has('weekly_rate_min'))
                @include('admin.common.alert-danger', ['error' => $errors->first('weekly_rate_min')])
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('weekly_rate_max') ? ' has-error' : '' }}">
            <label for="weekly_rate_max" class="control-label col-sm-4">Maximum Rate*</label>
            <div class="col-sm-6">
              <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                <input id="weekly_rate_max" type="text" class="form-control" name="weekly_rate_max" value="{{ $rate->weekly_rate_max }}" autocomplete="off">
              </div>
              @if( $errors->has('weekly_rate_max'))
                @include('admin.common.alert-danger', ['error' => $errors->first('weekly_rate_max')])
              @endif
            </div>
          </div>
        </form>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-4">
                <div class="btn-group">
                  <button type="submit" form="weekly_rate_edit_form" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  <a href="{{ route('admin.weekly-rates.index') }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
