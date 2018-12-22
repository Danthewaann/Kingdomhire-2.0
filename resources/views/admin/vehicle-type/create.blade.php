@extends('layouts.admin-main')

@section('content')
<div class="col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Add vehicle type</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.vehicle-types.store') }}" method="post">
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
          <div class="form-group">
            <div class="col-sm-4 col-sm-offset-4">
              <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Add Vehicle Type</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
