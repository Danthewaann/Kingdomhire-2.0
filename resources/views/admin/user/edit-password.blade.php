@extends('layouts.admin-main')

@section('content')
<div class="col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 style="padding-left: 5px">Change password</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.users.update-password', ['user' => $user->id]) }}" method="post">
          @csrf
          @method('PATCH')
          <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
            <label for="current_password" class="control-label col-sm-4">Current password*</label>
            <div class="col-sm-6">
              {{ Form::password('current_password', array(
                'class' => 'form-control', 'autocomplete' => 'off',
                'placeholder' => 'Enter current password'))
              }}
              @if( $errors->has('current_password'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('current_password') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
            <label for="new_password" class="control-label col-sm-4">New password*</label>
            <div class="col-sm-6">
              {{ Form::password('new_password', array(
                'class' => 'form-control', 'autocomplete' => 'off',
                'placeholder' => 'Enter new password'))
              }}
              @if( $errors->has('new_password'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('new_password') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
            <label for="new_password_confirmation" class="control-label col-sm-4">Confirm new password*</label>
            <div class="col-sm-6">
              {{ Form::password('new_password_confirmation', array(
                'class' => 'form-control', 'autocomplete' => 'off',
                'placeholder' => 'Enter new password'))
              }}
              @if( $errors->has('new_password_confirmation'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 col-xs-offset-4">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection