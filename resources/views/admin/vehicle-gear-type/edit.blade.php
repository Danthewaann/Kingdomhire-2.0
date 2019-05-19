@extends('layouts.admin-main')

@section('content')
<div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Edit gear type</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.vehicle-gear-types.update', ['vehicle_gar_type' => $vehicleGearType->slug]) }}" method="post" id="vehicle_gear_type_edit_form">
          @csrf
          @method('PATCH')
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label col-sm-4">Name*</label>
            <div class="col-sm-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $vehicleGearType->name }}" autocomplete="off">
              @if( $errors->has('name'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('name') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </form>
          <div class="form-group">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-4">
                <div class="btn-group">
                  <button type="submit" form="vehicle_gear_type_edit_form" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  <a href="{{ route('admin.vehicle-gear-types.index') }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
