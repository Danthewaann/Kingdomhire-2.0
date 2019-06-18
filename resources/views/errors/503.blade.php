@extends('layouts.error')

@section('content')
<div class="jumbtron jumbotron-with-bg">
  <div class="bg"></div>
  <div class="container">
    <div class="error-content">
      <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">
      <h1>
        @if($exception->getMessage() != null)
          {{ $exception->getMessage() }}...
        @else
          Kingdomhire is offline 
        @endif  
      </h1>
      <hr>
      <h2>
        We'll be right back!
      </h2>
    </div>
  </div>
</div>
@endsection