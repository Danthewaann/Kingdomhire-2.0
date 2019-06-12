<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Kingdomhire') }} | Car & Van Hire Specialist</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swatkins/gantt/css/gantt.css') }}" rel="stylesheet" type="text/css">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=sxQYcq">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=sxQYcq">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=sxQYcq">
  <link rel="manifest" href="/site.webmanifest?v=sxQYcq">
  <link rel="mask-icon" href="/safari-pinned-tab.svg?v=sxQYcq" color="#339966">
  <link rel="shortcut icon" href="/favicon.ico?v=sxQYcq">
  <meta name="msapplication-TileColor" content="#339966">
  <meta name="theme-color" content="#2c885a">
</head>
<body>
<div id="app">
  @include('layouts.admin-navbar-base')

  <div class="jumbotron jumbotron-admin">
    <div class="container">
      <div class="row">
        @if(session()->has('status'))
          <div class="col-lg-12">
            @include('admin.common.alert-success')
          </div>
        @endif
        @include('admin.vehicle.summaries.vehicle-dashboard')
        <div class="col-lg-8 col-md-8 col-sm-6">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  <div class="jumbotron jumbotron-admin-footer">
    <div class="container">
      <p>&copy; {{ date('Y') }} kingdomhire.com</p>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('js/datepicker.js') }}"></script>
<script src="{{ asset('js/modal-gallery.js') }}"></script>
</body>
</html>
