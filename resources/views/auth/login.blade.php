@extends('layouts.login')

@section('content')
<div class="jumbtron jumbotron-with-bg">
  <div class="bg"></div>
  <div class="container">
    <div class="flex-center position-ref full-height">
      <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-bottom: 30px">
            <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">
        </div>
        <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Login</h3>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email" class="col-sm-4 control-label">E-Mail Address</label>
                  <div class="col-sm-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                    @if ($errors->has('email'))
                      <div class="help-block">
                        <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('email') }}</strong>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-sm-4 control-label">Password</label>
                  <div class="col-sm-6">
                    <input id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                      <div class="help-block">
                        <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('password') }}</strong>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6 col-sm-offset-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-8 col-sm-offset-4">
                    <button type="submit" class="btn btn-primary">
                      Login
                    </button>
                    <a class="btn btn-link text-link" href="{{ route('password.request') }}">
                      Forgot Your Password?
                    </a>
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
