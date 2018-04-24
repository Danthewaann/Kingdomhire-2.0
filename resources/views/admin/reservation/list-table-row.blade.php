@foreach($vehicle->reservations as $reservation)
  <tr>
      @if(!empty($vehicles))
        <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
      @endif
      <td>{{ $reservation->start_date }}</td>
      <td>{{ $reservation->end_date }}</td>
      <td>{{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
        {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
      </td>
  </tr>
@endforeach
