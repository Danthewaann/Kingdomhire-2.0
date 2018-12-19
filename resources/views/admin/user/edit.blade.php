@extends('layouts.admin-main')

@section('content')
<div class="col-lg-4 col-lg-offset-4 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 style="padding-left: 5px">Change info</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post">
          @csrf
          @method('PATCH')
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label col-sm-4">Name*</label>
            <div class="col-sm-6">
              {{ Form::text('name', $user->name, array('class' => 'form-control', 'placeholder' => 'Enter Name')) }}
              @if( $errors->hires->has('name'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('name') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label col-sm-4">E-Mail*</label>
            <div class="col-sm-6">
              {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'Enter E-Mail')) }}
              @if( $errors->hires->has('email'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('email') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label col-sm-4">Confirm password*</label>
            <div class="col-sm-6">
              {{ Form::password('password', array(
                'class' => 'form-control', 'autocomplete' => 'off',
                'placeholder' => 'Enter password'))
              }}
              @if( $errors->has('password'))
                <div class="help-block">
                  <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('password') }}</strong>
                  </div>
                </div>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-4">
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