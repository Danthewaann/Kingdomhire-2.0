<nav class="navbar navbar-default navbar-static-top public-navbar">
    <header class="jumbotron jumbotron-nav">
        <div class="bg"></div>
        <div class="container">
        <div class="navbar-header public-navbar-header">
            <img src="{{ asset('static/Kingdomhire_logo.svg') }}" class="logo" alt="Kingdomhire logo">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        </div>
    </header>
    <div class="container">
        <div class="collapse navbar-collapse vehicle-dashboard-navbar-collapse" id="app-navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') || Request::is('home') ? 'active' : '' }}">
            <a href="{{ route('public.home') }}"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a>
            </li>
            <li class="{{ Request::is('vehicles') ? ' active' : '' }}">
            <a href="{{ route('public.vehicles') }}"><span class="glyphicon glyphicon-wrench"></span>&nbsp;&nbsp;Vehicles</a>
            </li>
            <li class="{{ Request::is('contact-us') ? ' active' : '' }}">
            <a href="{{ route('public.contact') }}"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;&nbsp;Contact Us</a>
            </li>
        </ul>
        @auth
            <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="{{ route('admin.home') }}"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Admin Dashboard</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('admin.users.edit', ['user' => Auth::user()->id]) }}">Update info</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.edit-password', ['user' => Auth::user()->id]) }}">Update password</a>
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
        @endauth
        </div>
    </div>
</nav>