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
  <link href="{{ asset('vendor/swatkins/gantt/css/gantt.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
  <nav class="navbar navbar-default navbar-static-top admin-navbar">
    <div class="jumbotron jumbotron-home">
      <div class="bg"></div>
      <div class="container-fluid">
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
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          <li class="{{ Request::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a>
          </li>
          <li class="dropdown{{ Request::is('admin/vehicles*') ? ' active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              <span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Vehicles <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{ route('admin.vehicle.addForm') }}">Add a vehicle</a>
              </li>
              {{--<li class="divider"></li>--}}
              <li class="dropdown-submenu">
                <a href="#" class="submenu">Vehicles list <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class="dropdown-header">Active vehicles</li>
                  @foreach(\App\Vehicle::all() as $activeVehicle)
                    <li>
                      <a href="{{ route('admin.vehicle.home', ['id' => $activeVehicle->id]) }}">{{ $activeVehicle->name() }}</a>
                    </li>
                  @endforeach
                  @if(\App\Vehicle::onlyTrashed()->get()->isNotEmpty())
                    <li class="divider"></li>
                    <li class="dropdown-header">Discontinued vehicles</li>
                    @foreach(\App\Vehicle::onlyTrashed()->get() as $inactiveVehicle)
                      <li>
                        <a href="{{ route('admin.vehicle.home', ['id' => $inactiveVehicle->id]) }}">{{ $inactiveVehicle->name() }}</a>
                      </li>
                    @endforeach
                  @endif
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown{{ Request::is('admin/rates*') ? ' active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              <span class="glyphicon glyphicon-gbp"></span>&nbsp;&nbsp;Weekly Rates <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{ route('admin.weekly-rate.add') }}">Add a weekly rate</a>
              </li>
              {{--<li class="divider"></li>--}}
              <li class="dropdown-submenu">
                <a href="{{ route('admin.weekly-rate.index') }}" class="submenu">Edit weekly rates <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  @foreach(\App\WeeklyRate::all() as $rate)
                    <li>
                      <a href="{{ route('admin.weekly-rate.edit', ['rate' => $rate->name]) }}">{{ $rate->getFullName() }}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
            </ul>
          </li>
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          <li>
            <a href="{{ route('public.home') }}"><span class="glyphicon glyphicon-globe"></span>&nbsp;&nbsp;Main Site</a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Account <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="#">Change password</a>
              </li>
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
        </ul>
      </div>
    </div>
  </nav>

  @include('admin.vehicle.dashboard-summary')
  <div class="col-lg-9 col-md-7 col-sm-7">
    @yield('content')
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $(document).ready(function () {
    $('.dropdown-submenu a.submenu').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
    $( "#start_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
    $("#start_date_calender").click(function () {
      $( "#start_date" ).focus();
    });
    $( "#end_date" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
    $("#end_date_calender").click(function () {
      $( "#end_date" ).focus();
    });

    // $("#hires_button").click(function () {
    //   $("#overall_vehicle_hires_per_month").show();
    // });
  });
</script>
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
