{{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading panel-title-text">--}}
        @if($vehicles->isEmpty())
            <h3>No vehicles present</h3>
        @else
            <h3>Vehicles</h3>
            <span>{{ count($vehicles) }} vehicle(s) in total</span>
        @endif
    {{--</div>--}}
    @if(!$vehicles->isEmpty())
        {{--<table class="table table-hover table-condensed vehicles-list">--}}
            {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>Vehicle</th>--}}
                    {{--<th>Status</th>--}}
                {{--</tr>--}}
            {{--</thead>--}}
            {{--@foreach($vehicles as $vehicle)--}}
              {{--@if($vehicle->is_active == true)--}}
                {{--<tr>--}}
                  {{--<td style="width: 45%;">--}}
                      {{--@foreach($vehicle->images as $image)--}}
                          {{--@if($loop->first) <img src="{{ $image->image_uri }}" style="height: 235px; width: 100%"/> @endif--}}
                      {{--@endforeach--}}
                  {{--</td>--}}
                  {{--<td>--}}
                      {{--<div style="width: 100%">--}}
                          {{--<table class="table table-condensed">--}}
                              {{--<tr>--}}
                                  {{--<th>Vehicle</th>--}}
                                  {{--<td><a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}"class="text-link">{{ $vehicle->name() }}</a> </td>--}}
                              {{--</tr>--}}
                              {{--<tr>--}}
                                  {{--<th>Type</th>--}}
                                  {{--<td>{{ $vehicle->type }}</td>--}}
                              {{--</tr>--}}
                              {{--<tr>--}}
                                  {{--<th>Fuel Type</th>--}}
                                  {{--<td>{{ $vehicle->fuel_type }}</td>--}}
                              {{--</tr>--}}
                              {{--<tr>--}}
                                  {{--<th>Gear Type</th>--}}
                                  {{--<td>{{ $vehicle->gear_type }}</td>--}}
                              {{--</tr>--}}
                              {{--<tr>--}}
                                  {{--<th>Seats</th>--}}
                                  {{--<td>{{ $vehicle->seats }}</td>--}}
                              {{--</tr>--}}
                              {{--<tr>--}}
                                  {{--<th>Status</th>--}}
                                  {{--<td>{{ $vehicle->status }}</td>--}}
                              {{--</tr>--}}
                              {{--<tr>--}}
                                  {{--<th class="last">Weekly Price Rate</th>--}}
                                  {{--<td>{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</td>--}}
                              {{--</tr>--}}
                          {{--</table>--}}
                      {{--</div>--}}
                  {{--</td>--}}
                  {{--<td>{{ $vehicle->status }}</td>--}}
                {{--</tr>--}}
              {{--@endif--}}
            {{--@endforeach--}}
        {{--</table>--}}
        <div class="col-md-12">
            <div class="row">
            @foreach($vehicles as $vehicle)
                {{--<div style="display: inline-block; width: 100%; margin-bottom: 20px">--}}
                <div class="col-md-12">
                    <div class="row">
                    @foreach($vehicle->images as $image)
                        <div class="col-md-5">
                            <div class="row">
                                <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">
                                    @if($loop->first) <img src="{{ $image->image_uri }}" class="vehicle-img"/> @endif
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-7">
                        <div class="row">
                            <table class="table table-condensed table-hover vehicle-table" style="height: 255px; margin-bottom: 22px !important;">
                                <tr>
                                    <th class="first">Vehicle</th>
                                    <td>{{ $vehicle->name() }}</td>
                                </tr>
                                {{--<tr>--}}
                                    {{--<th>Type</th>--}}
                                    {{--<td>{{ $vehicle->type }}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Fuel Type</th>--}}
                                    {{--<td>{{ $vehicle->fuel_type }}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Gear Type</th>--}}
                                    {{--<td>{{ $vehicle->gear_type }}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Seats</th>--}}
                                    {{--<td>{{ $vehicle->seats }}</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $vehicle->status }}</td>
                                </tr>
                                <tr>
                                    <th>Weekly Price Rate</th>
                                    <td>{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</td>
                                </tr>
                                <tr>
                                    <th>Active Hire</th>
                                    <td>
                                        @if($vehicle->hasActiveHire())
                                            Hired By: {{ $vehicle->getActiveHire()->hired_by }} <br>
                                            Starts: {{ date('jS F Y', strtotime($vehicle->getActiveHire()->start_date)) }} <br>
                                            Ends: {{ date('jS F Y', strtotime($vehicle->getActiveHire()->end_date)) }}
                                        @else
                                            No active hire
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="last">Next Reservation</th>
                                    <td>
                                        @if($vehicle->reservations->isNotEmpty())
                                            Made By: {{ $vehicle->getNextReservation()->made_by }} <br>
                                            Starts: {{ date('jS F Y', strtotime($vehicle->getNextReservation()->start_date)) }} <br>
                                            Ends: {{ date('jS F Y', strtotime($vehicle->getNextReservation()->end_date)) }}
                                        @else
                                            No reservations
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                {{--</div>--}}
            </div>
            @endforeach
        </div>
        </div>
    @endif
{{--</div>--}}
