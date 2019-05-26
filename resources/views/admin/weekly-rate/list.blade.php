@foreach($rates as $rate)
  @include('admin.weekly-rate.delete-modal')
@endforeach
<div class="panel panel-default">
  @if($rates->isNotEmpty())
    <div class="panel-heading">
      <h3>Weekly rates</h3>
      <h5>{{ count($rates) }} weekly rate(s) in total</h5>
    </div>
  @else
    <div class="panel-body">
      <h3>No weekly rates</h3>
    </div>
  @endif
  @if($rates->isNotEmpty())
    <div class="scrollable-table">
      <table class="table table-condensed panel-table">
        <thead>
        <tr>
          <th class="first">Name</th>
          <th>Min Rate</th>
          <th>Max Rate</th>
          <th>Vehicles</th>
          <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($rates as $rate)
          <tr>
            <td class="first">{{ $rate->name }}</td>
            <td>£{{ $rate->weekly_rate_min }}</td>
            <td>£{{ $rate->weekly_rate_max }}</td>
            <td>{{ $rate->vehicles->count() }}</td>
            <td>
              <div class="btn-group btn-group-vertical" style="width: 100%">
                <div class="btn-group">
                  <a href="{{ route('admin.weekly-rates.edit', ['rate' => $rate->slug]) }}"
                    class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#weekly-rate-{{ $rate->id }}-delete" style="float: right"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
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