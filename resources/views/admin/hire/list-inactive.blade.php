<div class="panel panel-default">
  <div class="panel-heading">
    @if(!$inactiveHires->isEmpty())
      <h3>Past hires</h3>
      <span>{{ count($inactiveHires) }} hire(s) in total</span>
    @else
      <h3>No past hires</h3>
    @endif
  </div>
  @if((!$inactiveHires->isEmpty()))
  <div class="panel-body">
    <div class="col-md-12">
    <div class="row">
      @foreach($vehicles as $vehicle)
        <div class="col-md-6">
          <div style="overflow: auto; max-height: 400px">
            <table class="table table-bordered table-hover table-condensed">
              <h3><a href="{{ route('vehicle.show', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}">{{ $vehicle->name() }} </a></h3>
              <span>{{ count($vehicle->getInactiveHires()) }} hire(s) in total</span>
              <thead>
              <tr>
                <th>Start Date</th>
                <th>End Date</th>
              </tr>
              </thead>
              @foreach($vehicle->getInactiveHires()->sortByDesc('end_date') as $hire)
                <tr>
                  <td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>
                  <td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      @endforeach
    </div>
    </div>
  </div>
  @endif
</div>