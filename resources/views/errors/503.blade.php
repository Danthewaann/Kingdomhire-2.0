@extends('layouts.login')

@section('content')
<div class="jumbtron jumbotron-with-bg">
  <div class="bg"></div>
  <div class="container">
    <div class="flex-center position-ref full-height">
      <div class="content">
        <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">
        <div class="title">
          @if($exception->getMessage() != null)
            {{ $exception->getMessage() }}...
          @else
            Kingdomhire is offline 
          @endif  
        </div>
        <div class="title">
          We'll be right back!
        </div>
      </div>
    </div>
  </div>
</div>
@endsection