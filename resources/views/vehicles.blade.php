@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Vehicle list</h3>
      @foreach($vehicles as $vehicle)
        <div class="col-md-4">
          <img src="{{ $vehicle->image_path }}" style="width: 300px; height: 200px;"/>
          <table class="table" style="width: 300px;">
            <tr>
              <td>Make</td>
              <td>{{ $vehicle->make }}</td>
            </tr>
            <tr>
              <td>Model</td>
              <td>{{ $vehicle->model }}</td>
            </tr>
            <tr>
              <td>Type</td>
              <td>{{ $vehicle->type }}</td>
            </tr>
            <tr>
              <td>Fuel Type</td>
              <td>{{ $vehicle->fuel_type }}</td>
            </tr>
            <tr>
              <td>Gear Type</td>
              <td>{{ $vehicle->gear_type }}</td>
            </tr>
            <tr>
              <td>Seats</td>
              <td>{{ $vehicle->seats }}</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>{{ $vehicle->status }}</td>
            </tr>
          </table>
        </div>
      @endforeach
    </div>
  </div>
@endsection
