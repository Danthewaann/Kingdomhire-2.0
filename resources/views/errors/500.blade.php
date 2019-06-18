@extends('layouts.error')

@section('content')
<div class="jumbtron jumbotron-with-bg">
  <div class="bg"></div>
  <div class="container">
    <div class="error-content">
      <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">
      <h1>Internal server error</h1>
      <hr>
      <a class="btn btn-lg btn-primary" role="button" href="{{ route('public.home') }}">Return to Kingdomhire</a>
    </div>
  </div>
</div>
@endsection