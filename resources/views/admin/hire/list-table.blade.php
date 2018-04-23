<table class="table">
  <thead>
    <tr>
      @if(!empty($vehicles))
        <th>Vehicle</th>
      @endif
      <th>Start Date</th>
      <th>End Date</th>
      <th></th>
    </tr>
  </thead>
  @if(!empty($vehicles))
    @foreach($vehicles as $vehicle)
      @include('admin.reservation.list-table-row')
    @endforeach
  @else
    @include('admin.reservation.list-table-row')
  @endif
</table>