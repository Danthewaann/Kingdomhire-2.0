<nav class="navbar navbar-default navbar-static-top vehicle-dashboard-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dashboard-navbar-collapse" aria-expanded="false">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
  </div>

  <div class="container-fluid">
    <div class="collapse navbar-collapse vehicle-dashboard-navbar-collapse" id="dashboard-navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
        <li class="{{ Request::path() == 'admin/vehicles/'.$vehicle->id ? 'active' : '' }}">
          <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">Vehicle Dashboard</a>
        </li>
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
            Other <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a>
                {{ Form::open(['route' => ['vehicle.discontinue', $vehicle->id], 'method' => 'delete']) }}
                {{ Form::submit('Discontinue', ['class' => 'button-link']) }}
                {{ Form::close() }}
              </a>
            </li>
            <li>
              <a>
                {{ Form::open(['route' => ['vehicle.delete', $vehicle->id], 'method' => 'delete']) }}
                {{ Form::submit('Delete', ['class' => 'button-link']) }}
                {{ Form::close() }}
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>