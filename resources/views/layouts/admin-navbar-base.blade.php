<nav class="navbar navbar-default navbar-static-top public-navbar">
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
              <a href="{{ route('admin.vehicles.create') }}">Add a vehicle</a>
            </li>
            {{--<li class="divider"></li>--}}
            <li class="dropdown-submenu">
              <a href="#" class="submenu">Vehicles list <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">Active vehicles</li>
                @foreach(\App\Vehicle::all() as $vehicle)
                  <li>
                    <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->id]) }}">{{ $vehicle->name() }}</a>
                  </li>
                @endforeach
                @if(\App\Vehicle::onlyTrashed()->get()->isNotEmpty())
                  <li class="divider"></li>
                  <li class="dropdown-header">Discontinued vehicles</li>
                  @foreach(\App\Vehicle::onlyTrashed()->get() as $vehicle)
                    <li>
                      <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->id]) }}">{{ $vehicle->name() }}</a>
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
              <a href="{{ route('admin.weekly-rates.create') }}">Add a weekly rate</a>
            </li>
            {{--<li class="divider"></li>--}}
            <li class="dropdown-submenu">
              <a href="#" class="submenu">Edit weekly rates <span class="caret"></span></a>
              <ul class="dropdown-menu">
                @foreach(\App\WeeklyRate::all() as $rate)
                  <li>
                    <a href="{{ route('admin.weekly-rates.edit', ['weekly_rate' => $rate->name]) }}">{{ $rate->getFullName() }}</a>
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