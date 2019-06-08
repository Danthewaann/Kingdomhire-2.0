@extends('layouts.login')

@section('content')
<div class="jumbotron jumbotron-content">
  <div class="container">
    <div class="flex-center position-ref full-height">
      <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 30px">
            <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">
        </div>
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading"><h3>Reset Password</h3></div>
            <div class="panel-body">
              <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  @if (session('status'))
                  <div class="col-sm-6 col-sm-offset-4">
                    <div class="help-block">
                      <div class="alert alert-success">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ session('status') }}</strong>
                      </div>
                    </div>
                  </div>
                  @endif
                  <label for="email" class="col-sm-4 control-label">E-Mail Address</label>
                  <div class="col-sm-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                      <div class="help-block">
                        <div class="alert alert-danger">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('email') }}</strong>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6 col-sm-offset-4">
                    <button type="submit" class="btn btn-primary">
                      Send Password Reset Link
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
