@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.navbar')
  <div class="row">
    @include('admin.vehicle.summary')
    <div class="col-md-6 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          @if(!$vehicle->reservations->isEmpty())
            <h3>Current reservations</h3>
          @else
            <h3>No current reservations</h3>
          @endif
        </div>
        @if(!$vehicle->reservations->isEmpty())
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                <tr>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th></th>
                  <th></th>
                </tr>
                </thead>
                @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
                  <tr>
                    <td>{{ $reservation->start_date }}</td>
                    <td>{{ $reservation->end_date }}</td>
                    <td>
                      {{ Form::open(['route' => ['reservation.cancel', $reservation->id], 'method' => 'delete']) }}
                      {{ Form::submit('Cancel', ['class' => 'btn btn-primary']) }}
                      {{ Form::close() }}
                    </td>
                    <td>
                      <a href="{{ route('reservation.editForm', ['vehicle_id' => $vehicle->id, 'reservation_id' => $reservation->id]) }}"
                         class="btn btn-primary" role="button" aria-pressed="true">Re-schedule</a>
                    </td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection