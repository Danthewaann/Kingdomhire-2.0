@extends('layouts.admin-main')

@section('content')
@include('admin.vehicle-type.delete-modal')
<div class="col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Edit vehicle type</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.vehicle-types.update', ['vehicle_type' => $vehicleType->name]) }}" method="post" id="vehicle_type_edit_form">
          @csrf
          @method('PATCH')
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label col-sm-4">Name*</label>
            <div class="col-sm-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $vehicleType->name }}" autocomplete="off">
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
              <div class="col-sm-2 col-sm-offset-4">
                <button type="submit" form="vehicle_type_edit_form" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
              </div>
              <div class="col-sm-3 col-sm-offset-1">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehicle-type-{{ $vehicleType->id }}-delete" style="float: right"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection
