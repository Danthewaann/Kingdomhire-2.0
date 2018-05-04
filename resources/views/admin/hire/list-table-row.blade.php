@if(!empty($vehicle) and (count($vehicle->hires) > 0))
  @foreach($vehicle->hires as $hire)
    <tr>
        @if(!empty($vehicles))
          <td><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}">{{ $vehicle->name() }}</a></td>
        @endif
        <td>{{ $hire->start_date }}</td>
        <td>{{ $hire->end_date }}</td>
        <td>
          <a href="{{ route('hire.edit', ['make' => $vehicle->make, 'model' => $vehicle->model, 'vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}"
             class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
        </td>
    </tr>
  @endforeach
@elseif(!empty($hires))
  @foreach($hires as $hire)
    <tr>
      <td><a href="{{ route('vehicle.show', ['make' => $hire->vehicle->make, 'model' => $hire->vehicle->model, 'id' => $hire->vehicle->id]) }}">{{ $hire->vehicle->name() }} </a></td>
      <td>{{ $hire->start_date }}</td>
      <td>{{ $hire->end_date }}</td>
      <td>
        <a href="{{ route('hire.edit', ['make' => $hire->vehicle->make, 'model' => $hire->vehicle->model, 'vehicle_id' => $hire->vehicle->id, 'hire_id' => $hire->id]) }}"
           class="btn btn-primary" role="button" aria-pressed="true">Shorten/Extend</a>
      </td>
    </tr>
  @endforeach
@endif
