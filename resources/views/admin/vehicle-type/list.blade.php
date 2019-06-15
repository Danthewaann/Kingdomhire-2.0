<div class="panel panel-default">
  @if($vehicleTypes->isNotEmpty())
    <div class="panel-heading">
      <h3>Vehicle types</h3>
      <h5>{{ count($vehicleTypes) }} vehicle type(s) in total</h5>
    </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No vehicle types</h3>
    </div>
  @endif
  @if($vehicleTypes->isNotEmpty())
    <div class="scrollable-table">
      <table class="table table-condensed panel-table">
        <thead>
        <tr>
          <th class="first">Name</th>
          <th>Vehicles</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($vehicleTypes as $vehicleType)
          <tr>
            <td class="first">{{ $vehicleType->name }}</td>
            <td>{{ $vehicleType->vehicles->count() }}</td>
            <td>
              <div class="btn-group btn-group-vertical" style="width: 100%">
                <div class="btn-group">
                  <a href="{{ route('admin.vehicle-types.edit', ['vehicle-type' => $vehicleType->slug]) }}"
                    class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehicle-type-{{ $vehicleType->id }}-delete" style="float: right"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>