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
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top public-navbar">
      <div class="jumbotron jumbotron-nav">
        <div class="bg"></div>
        <div class="container">
          <div class="navbar-header public-navbar-header">
            <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" width="100%">

          <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="collapse navbar-collapse vehicle-dashboard-navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}">
              <a href="{{ route('public.home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a>
            </li>
            <li class="{{ Request::is('vehicles') ? ' active' : '' }}">
              <a href="{{ route('public.vehicles') }}"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Vehicles</a>
            </li>
            <li class="{{ Request::is('contact') ? ' active' : '' }}">
              <a href="{{ route('public.contact') }}"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;&nbsp;Contact</a>
            </li>
          </ul>
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
              <li class="{{ Request::is('login') ? ' active' : '' }}">
                <a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Login</a>
              </li>
            @else
              <li>
                <a href="{{ route('admin.home') }}"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Admin Dashboard</a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                  <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret">
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
    @yield('content')
  </div>
  <div class="jumbotron jumbotron-footer">
    <div class="container">
      <!-- <span class="glyphicon glyphicon-copyright-mark"></span>  -->
      &copy; {{ date('Y') }} Kingdomhire.com
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/modal-gallery.js') }}"></script>
</body>
</html>
