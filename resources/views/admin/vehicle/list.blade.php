<div class="row">
    <div class="col-md-12">
    @if($vehicles->isEmpty())
        <h3>No vehicles present</h3>
    @else
        <h3>Vehicles</h3>
        <span>{{ count($vehicles) }} vehicle(s) in total</span>
    @endif
    </div>
</div>
@if($vehicles->isNotEmpty())
    <div class="row">
        <div class="col-md-12">
            <div style="overflow: auto; max-height: 869px">
                <div class="col-md-12">
                    <div class="row">
                    @foreach($vehicles as $vehicle)
                        <div class="col-md-12">
                            <div class="row">
                            @foreach($vehicle->images as $image)
                                <div class="col-md-6">
                                    <div class="row">
                                        <a href="{{ route('vehicle.show', ['id' => $vehicle->id]) }}">
                                            @if($loop->first) <img src="{{ $image->image_uri }}" class="vehicle-img"/> @endif
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-6">
                                <div class="row">
                                    <table class="table table-condensed vehicle-table" style=" margin-bottom: 22px !important;">
                                        <tr>
                                            <th class="first">Vehicle</th>
                                            <td>{{ $vehicle->name() }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $vehicle->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Weekly Price Rate</th>
                                            <td>
                                                @if($vehicle->rate != null)
                                                    {{ $vehicle->rate->name }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})
                                                @else
                                                    N/A
                                                @endif
                                            </td>
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
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
</div>
