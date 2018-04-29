@foreach($vehicle->hires as $hire)
  <tr>
      @if(!empty($vehicles))
        <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}">{{ $vehicle->make }} {{ $vehicle->model }}</a></td>
      @endif
      <td>{{ $hire->start_date }}</td>
      <td>{{ $hire->end_date }}</td>
      <td>
        <a href="{{ route('hire.edit', ['make' => $vehicle->make, 'model' => $vehicle->model, 'vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}"
           class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
      </td>
  </tr>
@endforeach
