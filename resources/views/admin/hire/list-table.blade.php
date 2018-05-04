<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        @if(!empty($hires))
          <th>Vehicle</th>
        @endif
        <th>Start Date</th>
        <th>End Date</th>
        <th></th>
      </tr>
    </thead>
    @include('admin.hire.list-table-row')
  </table>
</div>