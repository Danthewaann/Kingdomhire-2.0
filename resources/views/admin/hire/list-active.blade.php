<div class="panel panel-default">
  @if($activeHires->isNotEmpty())
    <div class="panel-heading">
      <h3>Active hires</h3>
      <span>{{ count($activeHires) }} hire(s) in total</span>
    </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No active hires</h3>
    </div>
  @endif
  @if($activeHires->count() > 0)
    <div class="scrollable-list" style="max-height: 570px">
      <table class="table table-condensed panel-table">
        <thead>
        <tr>
          <th class="first">ID</th>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($activeHires as $activeHire)
          <tr>
            <td class="first">{{ $activeHire->name }}</td>
            <td>{{ $activeHire->vehicle->name() }}</td>
            <td>{{ date('j/M/Y', strtotime($activeHire->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($activeHire->end_date)) }}</td>
            <td>
              <div class="btn-group btn-group-justified" style="width: inherit">
                <div class="btn-group">
                  <a href="{{ route('admin.hires.edit', ['hire' => $activeHire->name]) }}"
                     class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
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