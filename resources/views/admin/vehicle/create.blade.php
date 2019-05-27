@extends('layouts.admin-main')

@section('content')
<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
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
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('make') }}</strong>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                    <label for="model" class="control-label col-sm-3">Model*</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" autocomplete="off" placeholder="Enter model">
                      @if( $errors->has('model'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('model') }}</strong>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }}">
                    <label for="seats" class="control-label col-sm-3">Seats*</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="seats" name="seats" placeholder="Enter number of seats" value="{{ old('seats') }}" autocomplete="off">
                      @if( $errors->has('seats'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('seats') }}</strong>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="rate_name" class="control-label col-sm-3">Weekly Rate*</label>
                    <div class="col-sm-9">
                      <select id="rate_name" class="form-control" name="rate_name">
                        @if($rates->count() > 0)
                          <option disabled selected>Select...</option>
                        @else
                          <option value="" selected>N/A</option>
                        @endif
                        @foreach($rates as $rate)
                          <option value="{{ $rate->name }}">{{ $rate->getFullname() }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="type" class="control-label col-sm-3">Vehicle Type*</label>
                    <div class="col-sm-9">
                      <select id="type" class="form-control" name="type">
                        @if($types->count() > 0)
                          <option disabled selected>Select...</option>
                        @else
                          <option value="" selected>N/A</option>
                        @endif
                        @foreach($types as $type)
                          <option value="{{ $type->name }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fuel_type" class="control-label col-sm-3">Fuel Type*</label>
                    <div class="col-sm-9">
                      <select id="fuel_type" class="form-control" name="fuel_type">
                        @if($fuelTypes->count() > 0)
                          <option disabled selected>Select...</option>
                        @else
                          <option value="" selected>N/A</option>
                        @endif
                        @foreach($fuelTypes as $type)
                          <option value="{{ $type->name }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gear_type" class="control-label col-sm-3">Gear Type*</label>
                    <div class="col-sm-9">
                      <select id="gear_type" class="form-control" name="gear_type">
                        @if($gearTypes->count() > 0)
                          <option disabled selected>Select...</option>
                        @else
                          <option value="" selected>N/A</option>
                        @endif
                        @foreach($gearTypes as $type)
                          <option value="{{ $type->name }}">{{ $type->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('vehicle_images') ? ' has-error' : '' }}">
                    <label for="vehicle_image" class="control-label col-sm-3">Image(s)</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control" name="vehicle_images[]" id="vehicle_image" multiple>
                      @if( $errors->has('vehicle_images.*'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ array_values($errors->get('vehicle_images.*'))[0][0] }}</strong><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ array_values($errors->get('vehicle_images.*'))[0][1] }}
                          </div>
                        </div>
                      @endif
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
