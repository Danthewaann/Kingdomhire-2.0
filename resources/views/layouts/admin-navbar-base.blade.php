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
          <a href="{{ route('admin.vehicles.index') }}"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Vehicles</a>
        </li>
        <li class="{{ Request::is('admin/reservations*') ? 'active' : '' }}">
          <a href="{{ route('admin.reservations.index') }}"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Reservations</a>
        </li>
        <li class="{{ Request::is('admin/hires*') ? 'active' : '' }}">
          <a href="{{ route('admin.hires.index') }}"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Hires</a>
        </li>
        <li class="dropdown{{ Request::is('admin/other/*') ? ' active' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            <span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Other <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('admin.weekly-rates.index') }}">Weekly rates</a>
            </li>
            <li>
              <a href="{{ route('admin.vehicle-types.index') }}">Vehicle types</a>
            </li>
            <li>
              <a href="{{ route('admin.vehicle-fuel-types.index') }}">Fuel types</a>
            </li>
            <li>
              <a href="{{ route('admin.vehicle-gear-types.index') }}">Gear types</a>
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
        <li class="dropdown{{ Request::is('admin/users*') ? ' active' : '' }}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            <span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Users <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('admin.users.create') }}">Create a user</a>
            </li>
            <li>
              <a href="{{ route('admin.users.index') }}" class="submenu">Users</span></a>
            </li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="{{ route('admin.users.edit', ['user' => Auth::user()->id]) }}">Change info</a>
            </li>
            <li>
              <a href="{{ route('admin.users.edit-password', ['user' => Auth::user()->id]) }}">Change password</a>
            </li>
            <li>
              {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#user-{{ Auth::user()->id }}-delete"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Cancel</button>--}}
              <a href="#" data-toggle="modal" data-target="#user-{{ Auth::user()->id }}-delete">Delete account</a>
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
@include('admin.user.destroy-modal')