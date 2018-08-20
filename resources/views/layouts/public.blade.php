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
    <nav class="navbar navbar-default navbar-static-top public-navbar">
      <div class="jumbotron jumbotron-home">
        <div class="bg"></div>
        <div class="container">
          <div class="navbar-header public-navbar-header">
            <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" width="100%">

          <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
              <span class="sr-only">Toggle Navigation</span>
              <span class="glyphicon glyphicon-menu-hamburger"></span>
              {{--<span class="icon-bar"></span>--}}
              {{--<span class="icon-bar"></span>--}}
              {{--<span class="icon-bar"></span>--}}
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
              <a href={{ route('public.vehicles') }}><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Vehicles</a>
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
                  <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;{{ Auth::user()->name }}
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

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
      // Open the Modal
      function openModal(id) {
          document.getElementById(id).style.display = "block";
      }

      // Close the Modal
      function closeModal(id) {
          document.getElementById(id).style.display = "none";
      }

      var slideIndex = 1;
      // showSlides(slideIndex);

      // Next/previous controls
      function plusSlides(n, vehicle_id) {
          showSlides(slideIndex += n, vehicle_id);
      }

      // Thumbnail image controls
      function currentSlide(n, vehicle_id) {
          showSlides(slideIndex = n, vehicle_id);
      }

      function showSlides(n, vehicle_id) {
          var i;
          var slides = document.querySelectorAll('.'+vehicle_id);
          if (n > slides.length) {slideIndex = 1}
          if (n < 1) {slideIndex = slides.length}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";
          }
          slides[slideIndex-1].style.display = "block";
      }
  </script>
</body>
</html>
