<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <div class="container-fluid">
      <div style="max-width: 600px; min-width: 200px; padding: 10px; float: left;">
        <img src="{{ asset('static/Kingdomhire_logo.svg') }}" style="position: relative; width: 100%;"/>
      </div>
    </div>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            <a href="{{ route('public.home') }}" class="btn btn-primary btn-lg navbar-btn" role="button" aria-disabled="true">Home</a>
            <a href="{{ route('public.vehicles') }}" class="btn btn-primary btn-lg navbar-btn" role="button" aria-disabled="true">Vehicles</a>
            <a href="{{ route('public.contact') }}" class="btn btn-primary btn-lg navbar-btn" role="button" aria-disabled="true">Contact</a>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
              <a href="{{ route('login') }}" class="btn btn-primary btn-lg navbar-btn" role="button" aria-disabled="true">Login</a>
            @else
              <a href="{{ url('admin') }}" class="btn btn-primary btn-lg" role="button" aria-disabled="true">Admin</a>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                  </ul>
                </li>
              @endguest
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $(function() {
        $( ".datepicker" ).datepicker({
          dateFormat: "yy-mm-dd"
        });
      });
    </script>
</body>
</html>
