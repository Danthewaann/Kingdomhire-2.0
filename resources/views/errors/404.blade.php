@extends('layouts.login')

@section('content')
<div class="jumbtron jumbotron-content">
  <div class="container">
    <div class="flex-center position-ref full-height">
      <div class="content">
        <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">
        <div class="title">Page Not Found</div>
        <a class="btn btn-lg btn-primary" role="button" href="{{ route('public.home') }}">Return to Kingdomhire</a>
      </div>
    </div>
  </div>
</div>
@endsection