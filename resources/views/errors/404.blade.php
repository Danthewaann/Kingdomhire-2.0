@extends('layouts.login')

@section('content')
  <div class="jumbotron jumbotron-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 style="text-align: center">Page Not Found</h1>
          <hr>
          <div style="text-align: center">
            <a class="btn btn-lg btn-info" role="button" href="{{ route('public.home') }}">Return to Kingdomhire</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection