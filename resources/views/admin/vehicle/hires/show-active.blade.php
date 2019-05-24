<div class="panel panel-default">
  @if($vehicle->hasActiveHire())
  <div class="panel-heading">
    <h3>Active hire</h3>
  </div>
  @else
  <div class="panel-body">
    <h3>No active hire</h3>
  </div>
  @endif
  @if($vehicle->hasActiveHire())
    <div class="scrollable-table">
      <table class="table table-condensed panel-table">
        <thead>
          <tr>
            <th class="first">ID</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @include('admin.hire.destroy-modal', ['hire' => $vehicle->getActiveHire()])
            <td class="first">{{ $vehicle->getActiveHire()->name }}</td>
            <td>{{ date('j/M/Y', strtotime($vehicle->getActiveHire()->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($vehicle->getActiveHire()->end_date)) }}</td>
            <td>
              <div class="btn-group btn-group-vertical" style="width: 100%">
                <div class="btn-group btn-group-sm">
                  <a href="{{ route('admin.hires.edit', ['hire' => $vehicle->getActiveHire()]) }}"
                     class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </div>
                <div class="btn-group btn-group-sm">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hire-{{ $vehicle->getActiveHire()->name }}"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  @endif
</div>