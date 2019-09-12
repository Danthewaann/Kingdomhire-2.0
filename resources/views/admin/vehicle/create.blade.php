@extends('layouts.admin-main')

@section('content')
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Create new vehicle</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.vehicles.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }}">
                    <label for="make" class="control-label col-sm-3">Make*</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="make" name="make" value="{{ old('make') }}" autocomplete="off" placeholder="Enter make">
                      @if( $errors->has('make'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('make')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                    <label for="model" class="control-label col-sm-3">Model*</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" autocomplete="off" placeholder="Enter model">
                      @if( $errors->has('model'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('model')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }}">
                    <label for="seats" class="control-label col-sm-3">Seats*</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="seats" name="seats" placeholder="Enter number of seats" value="{{ old('seats') }}" autocomplete="off">
                      @if($errors->has('seats'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('seats')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                      <label for="status" class="control-label col-sm-3">Status*</label>
                      <div class="col-sm-9">
                        <select id="status" class="form-control" name="status">
                          <option disabled {{ old("status") == "" ? "selected" : "" }}>Select...</option>
                          <option value="unavailable" {{ old("status") == "Unavailable" ? "selected" : "" }}>Unavailable</option>
                          <option value="available" {{ old("status") == "Available" ? "selected" : "" }}>Available</option>
                        </select>
                        @if($errors->has('status'))
                          @include('admin.common.alert-danger', ['error' => $errors->first('status')])
                        @endif
                      </div>
                    </div>
                  <div class="form-group">
                    <label for="weeklyRate" class="control-label col-sm-3">Weekly Rate*</label>
                    <div class="col-sm-9">
                      <select id="weeklyRate" class="form-control" name="weeklyRate">
                        @if($weeklyRates->count() > 0)
                          <option disabled {{ old("weeklyRate") == "" ? "selected" : "" }}>Select...</option>
                        @endif
                        @foreach($weeklyRates as $rate)
                          <option value="{{ $rate->name }}" {{ old("weeklyRate") == $rate->name ? "selected" : "" }}>{{ $rate->full_name }}</option>
                        @endforeach
                        <option value="" {{ old("weeklyRate") == "" ? "selected" : "" }}>N/A</option>
                      </select>
                      @if($errors->has('weeklyRate'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('weeklyRate')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="type" class="control-label col-sm-3">Vehicle Type*</label>
                    <div class="col-sm-9">
                      <select id="type" class="form-control" name="type">
                        @if($vehicleTypes->count() > 0)
                          <option disabled {{ old("type") == "" ? "selected" : "" }}>Select...</option>
                        @endif
                        @foreach($vehicleTypes as $type)
                          <option value="{{ $type->name }}" {{ old("type") == $type->name ? "selected" : "" }}>{{ $type->name }}</option>
                        @endforeach
                        <option value="" {{ old("type") == "" ? "selected" : "" }}>N/A</option>
                      </select>
                      @if($errors->has('type'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('type')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fuelType" class="control-label col-sm-3">Fuel Type*</label>
                    <div class="col-sm-9">
                      <select id="fuelType" class="form-control" name="fuelType">
                        @if($fuelTypes->count() > 0)
                          <option disabled {{ old("fuelType") == "" ? "selected" : "" }}>Select...</option>
                        @endif
                        @foreach($fuelTypes as $type)
                          <option value="{{ $type->name }}" {{ old("fuelType") == $type->name ? "selected" : "" }}>{{ $type->name }}</option>
                        @endforeach
                        <option value="" {{ old("fuelType") == "" ? "selected" : "" }}>N/A</option>
                      </select>
                      @if($errors->has('fuelType'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('fuelType')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gearType" class="control-label col-sm-3">Gear Type*</label>
                    <div class="col-sm-9">
                      <select id="gearType" class="form-control" name="gearType">
                        @if($gearTypes->count() > 0)
                          <option disabled {{ old("gearType") == "" ? "selected" : "" }}>Select...</option>
                        @endif
                        @foreach($gearTypes as $type)
                          <option value="{{ $type->name }}" {{ old("gearType") == $type->name ? "selected" : "" }}>{{ $type->name }}</option>
                        @endforeach
                        <option value="" {{ old("gearType") == "" ? "selected" : "" }}>N/A</option>
                      </select>
                      @if($errors->has('gearType'))
                        @include('admin.common.alert-danger', ['error' => $errors->first('gearType')])
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('vehicle_images_add') ? ' has-error' : '' }}">
                    <label for="vehicle_images_add" class="control-label col-sm-3">Image(s)</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="vehicle_images_add[]" id="vehicle_images_add" multiple>
                      @if( $errors->has('vehicle_images_add.*'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ array_values($errors->get('vehicle_images_add.*'))[0][0] }}</strong><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ array_values($errors->get('vehicle_images_add.*'))[0][1] }}
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group" id="vehicle_image_order_container">
                    <label class="control-label col-sm-3">Image Order</label>
                    <div class="col-sm-9" id="vehicle_image_order_images">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Create</button>
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
