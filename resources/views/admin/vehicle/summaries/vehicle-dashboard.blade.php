@include('admin.vehicle.modals.image-gallery')
@includeWhen(!$vehicle->trashed() ,'admin.vehicle.modals.discontinue')
@include('admin.vehicle.modals.destroy')
<div class="col-lg-3 col-md-5 col-sm-5">
  <div class="well">
    @include('admin.common.alert')
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 style="text-align: center">Vehicle Dashboard</h2>
        <h4 style="text-align: center">{{ $vehicle->name() }}</h4>
      </div>

      <div style="display: inline-block; width: 100%;">
        @if($vehicle->images->isEmpty())
          <div class="vehicle-img vehicle-dashboard-img">
      <span style="display: inline-block;">
        <h2 style="margin: 0"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;Image N/A</h2>
      </span>
          </div>
        @else
          <div style="position: relative">
            <img src="{{ $vehicle->images->first()->image_uri }}" class="vehicle-img vehicle-dashboard-img"/>
            <div style="position: absolute; left: 0; top: 237px">
              <button class="btn btn-info vehicle-img-button" onclick="openModal('{{ $vehicle->slug }}');currentSlide(1, '{{ $vehicle->slug.'-images' }}')">View images</button>
            </div>
          </div>
        @endif
        <table class="table table-condensed vehicle-table-dashboard">
          <tr>
            <th class="first">Vehicle Id</th>
            <td class="first">{{ $vehicle->id }}</td>
          </tr>
          <tr>
            <th>Status</th>
            <td>{{ $vehicle->status }}</td>
          </tr>
          <tr>
            <th>Vehicle Type</th>
            <td>{{ $vehicle->type }}</td>
          </tr>
          <tr>
            <th>Fuel Type</th>
            <td>{{ $vehicle->fuel_type }}</td>
          </tr>
          <tr>
            <th>Gear Type</th>
            <td>{{ $vehicle->gear_type }}</td>
          </tr>
          <tr>
            <th>Seats</th>
            <td>{{ $vehicle->seats }}</td>
          </tr>
          <tr>
            <th>Date Added</th>
            <td>{{ date('j/M/Y H:ia', strtotime($vehicle->created_at)) }}</td>
          </tr>
          <tr>
            @if($vehicle->trashed())
              <th>Date Discontinued</th>
              <td>{{ date('j/M/Y H:ia', strtotime($vehicle->deleted_at)) }}</td>
            @else
              <th>Last Changed</th>
              <td>{{ date('j/M/Y H:ia', strtotime($vehicle->updated_at)) }}</td>
            @endif
          </tr>
          <tr>
            <th class="last">Weekly Rate</th>
            <td class="last">
              @if($vehicle->rate != null)
                {{ $vehicle->rate->getFullName() }}
              @else
                N/A
              @endif
            </td>
          </tr>
        </table>
      </div>

      <div class="panel-footer">
        @if($vehicle->trashed())
          {{ Form::open(['route' => ['admin.vehicles.recontinue', $vehicle->slug], 'method' => 'patch', 'id' => 'vehicle_recontinue_form']) }}
          {{ Form::close() }}
        @endif
        <div class="row">
          <div class="col-lg-12">
            <div class="btn-group btn-group-justified" style="table-layout: unset">
              @if(!$vehicle->trashed())
                <div class="btn-group">
                  <a class="btn btn-primary" href="{{ route('admin.vehicles.edit', ['vehicle' => $vehicle->slug]) }}"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehicle-{{ $vehicle->id }}-discontinue"><span class="glyphicon glyphicon-lock"></span>&nbsp;&nbsp;Discontinue</button>
                </div>
              @else
                <div class="btn-group">
                  <button type="submit" form="vehicle_recontinue_form" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Re-continue</button>
                </div>
              @endif
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#vehicle-{{ $vehicle->id }}-delete"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>