@foreach($vehicle->hires as $hire)
  <tr>
      @if(!empty($vehicles))
        <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
        @if($vehicle->is_active == true)
          <td>Yes</td>
        @else
          <td>No</td>
        @endif
      @endif
      <td>{{ $hire->start_date }}</td>
      <td>{{ $hire->end_date }}</td>
  </tr>
@endforeach
