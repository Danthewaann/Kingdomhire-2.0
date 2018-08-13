@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="col-md-5 col-sm-8 col-xs-12">
    <div class="well">
      <div class="row">
        <div class="col-md-12">
          <h3>Add a vehicle</h3>
        </div>
          <form action="{{ route('vehicle.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }} col-xs-6">
                <label for="make">Make*</label>
                <input type="text" class="form-control" id="make" name="make" value="{{ old('make') }}" autocomplete="off" placeholder="Enter make">
                @if( $errors->has('make'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('make') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
              <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }} col-xs-6">
                <label for="model">Model*</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" autocomplete="off" placeholder="Enter model">
                @if( $errors->has('model'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('model') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-xs-6">
                <label for="fuel_type">Fuel Type*</label>
                <select id="fuel_type" class="form-control" name="fuel_type">
                  <option selected>Petrol</option>
                  <option>Diesel</option>
                </select>
              </div>
              <div class="form-group col-xs-6">
                <label for="gear_type">Gear Type*</label>
                <select id="gear_type" class="form-control" name="gear_type">
                  <option selected>Manuel</option>
                  <option>Automatic</option>
                  <option>Manuel & Automatic</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }} col-xs-6">
                <label for="seats">Seats*</label>
                <input type="text" class="form-control" id="seats" name="seats" placeholder="Enter number of seats" value="{{ old('seats') }}" autocomplete="off">
                @if( $errors->has('seats'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('seats') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
              <div class="form-group col-xs-6">
                <label for="type">Type*</label>
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
                <label for="rate_name">Weekly Rate*</label>
                <select id="rate_name" class="form-control" name="rate_name">
                  @foreach($rates as $rate)
                    <option value="{{ $rate->name }}">{{ $rate->getFullname() }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group{{ $errors->has('vehicle_images') ? ' has-error' : '' }} col-xs-6">
                <label for="vehicle_image">Image(s)</label>
                <input type="file" class="form-control" name="vehicle_images[]" id="vehicle_image" multiple>
                @if( $errors->has('vehicle_images'))
                  <span class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('vehicle_images') }}</strong>
                    </div>
                  </span>
                @endif
              </div>
            </div>
              <div class="form-row">
                <div class="col-xs-12">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;Add Vehicle</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
