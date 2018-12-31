<div class="panel panel-default">
  @if(!$inactiveHires->isEmpty())
  <div class="panel-heading">
    <h3>Past hires</h3>
    <span>{{ count($inactiveHires) }} hire(s) in total</span>
  </div>
  @else
    <div class="panel-body">
      <h3 style="margin-left: -5px">No active hires</h3>
    </div>
  @endif
  @if($inactiveHires->count() > 0)
    <div class="scrollable-table" style="max-height: 570px">
      <table class="table table-condensed panel-table">
        <thead>
        <tr>
          <th class="first">ID</th>
          <th>Vehicle</th>
          <th>Start Date</th>
          <th>End Date</th>
          {{--<th></th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($inactiveHires as $activeHire)
          <tr>
            <td class="first">{{ $activeHire->name }}</td>
            <td>{{ $activeHire->vehicle->name() }}</td>
            <td>{{ date('j/M/Y', strtotime($activeHire->start_date)) }}</td>
            <td>{{ date('j/M/Y', strtotime($activeHire->end_date)) }}</td>
            {{--<td>--}}
              {{--<div class="btn-group btn-group-justified" style="width: inherit">--}}
                {{--<div class="btn-group">--}}
                  {{--<a href="{{ route('admin.hires.edit', ['hire' => $activeHire]) }}"--}}
                     {{--class="btn btn-primary" role="button" aria-pressed="true"><span class="glyphicon glyphicon-edit"></span>&nbsp;&nbsp;Edit</a>--}}
                {{--</div>--}}
              {{--</div>--}}
            {{--</td>--}}
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  @endif
  {{--@if((!$inactiveHires->isEmpty()))--}}
  {{--<div class="panel-body">--}}
    {{--<div class="col-md-12">--}}
      {{--<div class="row">--}}
        {{--@foreach($vehicles as $vehicle)--}}
          {{--<div class="col-md-6">--}}
            {{--<div style="overflow: auto; max-height: 400px">--}}
              {{--<table class="table table-bordered table-hover table-condensed">--}}
                {{--<h3><a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->slug]) }}">{{ $vehicle->name() }} </a></h3>--}}
                {{--<span>{{ count($vehicle->getInactiveHires()) }} hire(s) in total</span>--}}
                {{--<thead>--}}
                {{--<tr>--}}
                  {{--<th>Start Date</th>--}}
                  {{--<th>End Date</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--@foreach($vehicle->getInactiveHires()->sortByDesc('end_date') as $hire)--}}
                  {{--<tr>--}}
                    {{--<td>{{ date('jS F Y', strtotime($hire->start_date)) }}</td>--}}
                    {{--<td>{{ date('jS F Y', strtotime($hire->end_date)) }}</td>--}}
                  {{--</tr>--}}
                {{--@endforeach--}}
              {{--</table>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--@endforeach--}}
      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}
  {{--@endif--}}
</div>