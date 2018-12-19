<div class="panel panel-default">
  <div class="panel-heading panel-title-text">
    @if(!$activeHires->isEmpty())
      <h3>Active hires</h3>
      <span>{{ count($activeHires) }} hire(s) in total</span>
    @else
      <h3>No active hires</h3>
    @endif
  </div>
  @if((!$activeHires->isEmpty()))
    <div style="overflow: auto; max-height: 400px">
      <table class="table table-hover table-condensed table-responsive">
        <thead>
        <tr>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        @foreach($activeHires as $hire)
          <tr>
            <td><a href="{{ route('vehicle.show', ['id' => $hire->vehicle->id]) }}">{{ $hire->vehicle->name() }} </a></td>
            <td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>
            <td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>
            <td>
              <a style="width: 100%" href="{{ route('hire.edit', ['vehicle_id' => $hire->vehicle->id, 'hire_id' => $hire->id]) }}"
                 class="btn btn-primary btn-sm" role="button" aria-pressed="true">Shorten/Extend</a>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  @endif
</div>