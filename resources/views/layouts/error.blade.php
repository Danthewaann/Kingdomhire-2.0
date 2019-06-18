<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Error | Kingdomhire - Car & Van Rental Agency</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
  <main class="login">
    @yield('content')
  </main>
  <footer class="jumbotron jumbotron-footer">
    <div class="container">
      <p>&copy; {{ date('Y') }} kingdomhire.com</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/modal-gallery.js') }}"></script>
</body>
</html>
