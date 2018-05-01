<table class="table">
  <thead>
    <tr>
      @if(!empty($vehicles) or !empty($hires))
        <th>Vehicle</th>
      @endif
      <th>Start Date</th>
      <th>End Date</th>
      <th></th>
    </tr>
  </thead>
  @if(!empty($vehicles))
    @foreach($vehicles as $vehicle)
      @include('admin.hire.list-table-row')
    @endforeach
  @else
    @include('admin.hire.list-table-row')
  @endif
</table>