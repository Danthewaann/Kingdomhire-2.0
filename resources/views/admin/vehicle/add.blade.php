@extends('layouts.admin-main')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading"><h3>Add a vehicle</h3></div>
  <div class="panel-body">
  <form action="{{ route('vehicle.add') }}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-row">
          <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }} col-xs-6">
              <label for="make">Vehicle Make</label>
              <input type="text" class="form-control" id="make" name="make" placeholder="Enter make">
              @if( $errors->has('make'))
                <span class="help-block">
                    <strong>{{ $errors->first('make') }}</strong>
                </span>
              @endif
          </div>
          <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }} col-xs-6">
              <label for="model">Vehicle Model</label>
              <input type="text" class="form-control" id="model" name="model" placeholder="Enter model">
              @if( $errors->has('model'))
                  <span class="help-block">
                    <strong>{{ $errors->first('model') }}</strong>
                </span>
              @endif
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
          <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }} col-xs-6">
              <label for="seats">Vehicle Seats</label>
              <input type="text" class="form-control" id="seats" name="seats" placeholder="Enter number of seats">
              @if( $errors->has('seats'))
                  <span class="help-block">
                    <strong>{{ $errors->first('seats') }}</strong>
                </span>
              @endif
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
                @foreach($rates as $rate)
                  <option value="{{ $rate->engine_size }}">{{ $rate->engine_size }} (£{{ $rate->weekly_rate_min }}-£{{ $rate->weekly_rate_max }})</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-xs-6">
              <label for="vehicle_image">Vehicle Image (optional)</label>
              <input type="file" class="form-control" name="vehicle_images[]" id="vehicle_image" multiple>
          </div>

      </div>
      <div class="form-row">
          <div class="col-xs-12">
              <button type="submit" class="btn btn-primary">Add Vehicle</button>
          </div>
      </div>
  </form>
  </div>
</div>
@endsection
