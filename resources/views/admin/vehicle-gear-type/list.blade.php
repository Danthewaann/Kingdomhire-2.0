@foreach($vehicleGearTypes as $vehicleGearType)
  @include('admin.vehicle-gear-type.delete-modal')
@endforeach
<div class="panel panel-default">
  @if($vehicleGearTypes->isNotEmpty())
    <div class="panel-heading">
      <h3>Gear types</h3>
      <h5>{{ count($vehicleGearTypes) }} gear type(s) in total</h5>
    </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No vehicle gear types</h3>
    </div>
  @endif
  @if($vehicleGearTypes->isNotEmpty())
    <table class="table panel-table table-responsive">
      <tr>
        <th class="first">Name</th>
        <th>Vehicles</th>
        <th></th>
      </tr>
      @foreach($vehicleGearTypes as $vehicleGearType)
        <tr>
          <td class="first">{{ $vehicleGearType->name }}</td>
          <td>{{ $vehicleGearType->vehicles->count() }}</td>
          <td>
            <div class="btn-group btn-group-vertical" style="width: 100%">
              <div class="btn-group">
                <a href="{{ route('admin.vehicle-gear-types.edit', ['vehicle-gear-type' => $vehicleGearType->slug]) }}"
                   class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehicle-gear-type-{{ $vehicleGearType->id }}-delete" style="float: right"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </table>
  @endif
</div>