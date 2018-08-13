@if(!$vehicle->reservations->isEmpty())
    <h3>Next reservation</h3>
@else
    <h3>No reservations</h3>
@endif
@if(!$vehicle->reservations->isEmpty())
<div style="overflow-y: auto; max-height: 570px">
  <table class="table table-condensed">
      <tr>
          <th>Made By</th>
          <th>Rate</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
      </tr>
      <tr>
          <td>{{ $vehicle->reservations->sortBy('end_date')->first()->made_by }}</td>
          <td>
              @if($vehicle->reservations->sortBy('end_date')->first()->rate != null)
                  £{{ $vehicle->reservations->sortBy('end_date')->first()->rate }}
              @else
                  Not assigned
              @endif
          </td>
          <td>{{ date('jS F Y', strtotime($vehicle->reservations->sortBy('end_date')->first()->start_date)) }}</td>
          <td>{{ date('jS F Y', strtotime($vehicle->reservations->sortBy('end_date')->first()->end_date)) }}</td>
          <td>
              <a style="width: 100%" href="{{ route('reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $vehicle->reservations->sortBy('end_date')->first()->id]) }}"
                 class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span> Edit
              </a>
              {{ Form::open(['route' => ['reservation.cancel', $vehicle->reservations->sortBy('end_date')->first()->id], 'method' => 'delete']) }}
              <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 5px;"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
              {{--{{ Form::submit('Cancel', ['class' => 'btn btn-primary', 'style' => 'width: 100%; margin-top: 5px;']) }}--}}
              {{ Form::close() }}
          </td>
      </tr>
  </table>
</div>
@endif