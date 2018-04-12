@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(!empty($vehicles))
        <div class="row">
            <div class="col-md-3">
                <h3>Vehicle list</h3>
                <table class="table">
                    <th>Vehicle</th>
                    <th>Status</th>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td style="width: 250px;">{{ $vehicle->make }} {{ $vehicle->model }}</td>
                            <td>{{ $vehicle->status }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-5">
                <form action="{{url('admin/addVehicle')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="col-xs-12">
                            <h3>Add a vehicle</h3>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-6">
                            <label for="make">Vehicle Make</label>
                            <input type="text" class="form-control" id="make" name="make" placeholder="Enter make">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="model">Vehicle Model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Enter model">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-6">
                            <label for="fuel_type">Vehicle Fuel Type</label>
                            <select id="fuel_type" class="form-control" name="fuel_type">
                                <option selected>Petrol</option>
                                <option>Diesel</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="gear_type">Vehicle Gear Type</label>
                            <select id="gear_type" class="form-control" name="gear_type">
                                <option selected>Manuel</option>
                                <option>Automatic</option>
                                <option>Manuel & Automatic</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-6">
                            <label for="seats">Vehicle Seats</label>
                            <input type="text" class="form-control" id="seats" name="seats" placeholder="Enter number of seats">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="type">Vehicle Type</label>
                            <select id="type" class="form-control" name="type">
                                <option selected>Hatchback</option>
                                <option>4-by-4</option>
                                <option>Small Van</option>
                                <option>Large Van</option>
                                <option>4-door Salon</option>
                                <option>People Carrier</option>
                            </select>
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="engine_size">Engine Size</label>
                            <select id="engine_size" class="form-control" name="engine_size">
                                <option selected>Small</option>
                                <option>Medium</option>
                                <option>Large</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary">Add Vehicle</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form action="{{ url('admin/deleteVehicle') }}" method="post">
                    {{csrf_field()}}
                    <div class="form-row">
                        <div class="col-xs-12">
                            <h3>Delete a vehicle</h3>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-xs-6">
                            <label for="delete">Vehicle</label>
                            <select id="delete" class="form-control" name="delete">
                                @if(!empty($vehicles))
                                    @foreach($vehicles as $vehicle)
                                        <option>{{ $vehicle->make }} {{ $vehicle->model }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    <div class="form-row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary">Delete Vehicle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    </div>
<div class="row">
    <div class="col-md-5">
        <h3>Reservations</h3>
        <table class="table">
            <th>Reservation Id</th>
            <th>Vehicle</th>
            <th>Start Date</th>
            <th>End Date</th>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->vehicle->make }}</td>
                    <td>{{ $reservation->start_date }}</td>
                    <td>{{ $reservation->end_date }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-md-4">
        <form action="{{ url('admin/logReservation') }}" method="post">
            {{csrf_field()}}
            <div class="form-row">
                <div class="col-xs-12">
                    <h3>Log a vehicle reservation</h3>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-6">
                    <label for="vehicle">Vehicle</label>
                    <select id="vehicle" class="form-control" name="vehicle">
                        @if(!empty($vehicles))
                            @foreach($vehicles as $vehicle)
                                <option>{{ $vehicle->make }} {{ $vehicle->model }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary">Log Reservation</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <form action="{{ url('admin/deleteReservation') }}" method="post">
            {{csrf_field()}}
            <div class="form-row">
                <div class="col-xs-12">
                    <h3>Delete a reservation</h3>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-xs-6">
                    <label for="reservation">Reservation Id</label>
                    <select id="reservation" class="form-control" name="reservation">
                        @if(!empty($reservations))
                            @foreach($reservations as $reservation)
                                <option>{{ $reservation->vehicle->make }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary">Delete Reservation</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
