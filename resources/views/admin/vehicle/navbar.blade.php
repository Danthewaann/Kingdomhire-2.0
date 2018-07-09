<div class="panel panel-default">
  <div class="panel-heading panel-title-text vehicle-dashboard-heading">
    <div class="vehicle-dashboard-header">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
              {{--<div style="width: 100%; position: relative; display: block">--}}
              @foreach($vehicle->images as $image)
                @if($loop->first) <img src="{{ $image->image_uri }}" width="100%"/> @endif
              @endforeach
                {{--@include('admin.vehicle.summary') style="min-width: 45%; width: 100%; max-width: 700px; float: left"  --}}
              {{--</div>--}}
            </div>
            {{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">--}}
              {{--@include('admin.vehicle.summary')--}}
              {{--@include('admin.vehicle.list-reservations')--}}
              {{--<div>--}}
                {{--<table class="table table-bordered table-condensed" style="margin-left: unset">--}}
                  {{--<tr>--}}
                    {{--<td>Vehicle</td>--}}
                    {{--<td>{{ $vehicle->name() }}</td>--}}
                  {{--</tr>--}}
                  {{--<tr>--}}
                    {{--<td>Type</td>--}}
                    {{--<td>{{ $vehicle->type }}</td>--}}
                  {{--</tr>--}}
                  {{--<tr>--}}
                    {{--<td>Fuel Type</td>--}}
                    {{--<td>{{ $vehicle->fuel_type }}</td>--}}
                  {{--</tr>--}}
                  {{--<tr>--}}
                    {{--<td>Gear Type</td>--}}
                    {{--<td>{{ $vehicle->gear_type }}</td>--}}
                  {{--</tr>--}}
                  {{--<tr>--}}
                    {{--<td>Seats</td>--}}
                    {{--<td>{{ $vehicle->seats }}</td>--}}
                  {{--</tr>--}}
                  {{--<tr>--}}
                    {{--<td>Status</td>--}}
                    {{--<td>{{ $vehicle->status }}</td>--}}
                  {{--</tr>--}}
                  {{--<tr>--}}
                    {{--<td>Weekly Price Rate</td>--}}
                    {{--<td>{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</td>--}}
                  {{--</tr>--}}
                {{--</table>--}}
              {{--</div>--}}
            {{--</div>--}}
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-default navbar-static-top vehicle-dashboard-navbar">
      <div class="navbar-header" style="width: 100%">
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dashboard-navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse vehicle-dashboard-navbar-collapse" id="dashboard-navbar-collapse">
        <!-- Left Side Of Navbar -->
        <ul class="nav navbar-nav">
          <li>
            <a class="vehicle-dashboard-brand">Vehicle Dashboard</a>
          </li>
          <li class="{{ Request::path() == 'admin/vehicles/'.$vehicle->id ? 'active' : '' }}">
            <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">Home</a>
          </li>
          <li class="{{ Request::path() == 'admin/vehicles/'.$vehicle->id.'/edit' ? 'active' : '' }}">
            <a href="{{ route('vehicle.editForm', ['id' => $vehicle->id]) }}">Edit</a>
          </li>
          <li class="dropdown{{ Request::path() == 'admin/vehicles/'.$vehicle->id.'/reservations' ? ' active' : '' }}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
              Reservations <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <a href="{{ route('vehicle.reservations', ['id' => $vehicle->id]) }}">Show reservations</a>
              </li>
              <li>
                <a href="{{ route('reservation.form', ['id' => $vehicle->id]) }}">Log reservation</a>
              </li>
            </ul>
          </li>
          <li class="{{ Request::path() == 'admin/vehicles/'.$vehicle->id.'/hires' ? 'active' : '' }}">
            <a href="{{ route('vehicle.hires', ['id' => $vehicle->id]) }}">Hires</a>
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
    </nav>
  </div>
</div>