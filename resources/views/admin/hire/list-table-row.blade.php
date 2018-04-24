@foreach($vehicle->hires as $hire)
  <tr>
      @if(!empty($vehicles))
        <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
      @endif
      <td>{{ $hire->start_date }}</td>
      <td>{{ $hire->end_date }}</td>
      <td>{{ Form::open(['route' => ['hire.cancel', $hire->id], 'method' => 'delete']) }}
        {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
        {{ Form::close() }}
      </td>
  </tr>
@endforeach
