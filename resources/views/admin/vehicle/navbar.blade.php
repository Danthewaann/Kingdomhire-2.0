<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading panel-title-text"><h1>{{ $vehicle->name() }} Dashboard</h1></div>
      <div class="panel-body" style="padding: unset">
        <ul class="nav navbar-nav" style="padding: 10px;">
          <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Home</a>
          <a href="{{ route('vehicle.editForm', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Edit</a>
          <a href="{{ route('vehicle.reservations', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Reservations</a>
          <a href="{{ route('vehicle.hires', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Hires</a>
          <a href="{{ route('reservation.form', ['id' => $vehicle->id]) }}"
             class="btn btn-primary" style="margin: 1px;" role="button" aria-pressed="true">Log Reservation</a>
          {{ Form::open(['route' => ['vehicle.discontinue', $vehicle->id], 'style' => 'display: inline-block; margin: 1px;', 'method' => 'delete']) }}
          {{ Form::submit('Discontinue', ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
          {{ Form::open(['route' => ['vehicle.delete', $vehicle->id], 'style' => 'display: inline-block; margin: 1px;', 'method' => 'delete']) }}
          {{ Form::submit('Delete', ['class' => 'btn btn-primary']) }}
          {{ Form::close() }}
        </ul>
      </div>
    </div>
  </div>
</div>