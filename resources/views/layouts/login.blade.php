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
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=bOMa9p6jxO">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=bOMa9p6jxO">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=bOMa9p6jxO">
  <link rel="manifest" href="/site.webmanifest?v=bOMa9p6jxO">
  <link rel="mask-icon" href="/safari-pinned-tab.svg?v=bOMa9p6jxO" color="#339966">
  <link rel="shortcut icon" href="/favicon.ico?v=bOMa9p6jxO">
  <meta name="msapplication-TileColor" content="#339966">
  <meta name="theme-color" content="#339966">
</head>
<body>
  <div id="app">
    @yield('content')
    <div class="jumbotron jumbotron-footer">
      <div class="container">
        <p>&copy; {{ date('Y') }} kingdomhire.com</p>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/modal-gallery.js') }}"></script>
</body>
</html>
