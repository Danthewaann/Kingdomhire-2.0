<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Yearly hires</h3>
  </div>
  <table class="table table-condensed table-bordered panel-table-2">
    <thead>
      <tr>
        <th class="first">Year</th>
        <th>Hires</th>
      </tr>
    </thead>
    <tbody>
      @foreach($yearlyHires as $year => $hires)
        <tr>
          <td class="first">{{ $year }}</td>
          <td>{{ $hires }}</td>
        </tr>
      @endforeach
      <tr>
        <td class="first">Total hires</td>
        <td>{{ $inactiveHires->count() }}</td>
      </tr>
    </tbody>
  </table>
</div>