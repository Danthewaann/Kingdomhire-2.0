@extends('layouts.admin-vehicle-dashboard')

@section('content')
{{-- @dd($errors) --}}
<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Edit vehicle</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12">
        <form class="form-horizontal" action="{{ route('admin.vehicles.update', ['vehicle' => $vehicle->slug]) }}" method="post" enctype="multipart/form-data" id="vehicle_edit_form">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="make" class="control-label col-sm-3">Make</label>
                <div class="col-sm-9">
                  <input type="text" id="make" class="form-control" name="make" value="{{ $vehicle->make }}"/>
                  @if( $errors->has('make'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('make')])
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="model" class="control-label col-sm-3">Model</label>
                <div class="col-sm-9">
                  <input type="text" id="model" class="form-control" name="model" value="{{ $vehicle->model }}"/>
                  @if( $errors->has('model'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('model')])
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="seats" class="control-label col-sm-3">Seats</label>
                <div class="col-sm-9">
                  <input type="number" id="seats" class="form-control" name="seats" value="{{ $vehicle->seats }}"/>
                  @if( $errors->has('seats'))
                    @include('admin.common.alert-danger', ['error' => $errors->first('seats')])
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="status" class="control-label col-sm-3">Status</label>
                <div class="col-sm-9">
                  @if($vehicle->status == 'Out for hire')
                    <input type="text" id="status" class="form-control" disabled value="{{ $vehicle->status }}">
                  @else
                  <select id="status" class="form-control" name="status">
                    <option value="{{ $vehicle->status }}">{{ $vehicle->status }}</option>
                    @if($vehicle->status == 'Available')
                      <option value="Unavailable">Unavailable</option>
                    @else
                      <option value="Available">Available</option>
                    @endif
                  </select>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="weeklyRate" class="control-label col-sm-3">Weekly Rate</label>
                <div class="col-sm-9">
                  <select id="weeklyRate" class="form-control" name="weeklyRate">
                    <option value="{{ $vehicle->weeklyRate != null ? $vehicle->weeklyRate->name : '' }}" selected>{{ $vehicle->weeklyRate != null ? $vehicle->weeklyRate->full_name : 'N/A' }}</option>
                    @foreach($weeklyRates as $weeklyRate)
                        @if($vehicle->weeklyRate != null)
                          @if($weeklyRate->name != $vehicle->weeklyRate->name)
                            <option value="{{ $weeklyRate->name }}">{{ $weeklyRate->full_name }}</option>
                          @endif
                        @else
                          <option value="{{ $weeklyRate->name }}">{{ $weeklyRate->full_name }}</option>
                        @endif
                    @endforeach
                    @if($vehicle->weeklyRate != null)
                      <option value="">N/A</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="type" class="control-label col-sm-3">Vehicle Type</label>
                <div class="col-sm-9">
                  <select id="type" class="form-control" name="type">
                    <option value="{{ $vehicle->type != null ? $vehicle->type->name : '' }}" selected>{{ $vehicle->type != null ? $vehicle->type->name : 'N/A' }}</option>
                    @foreach($vehicleTypes as $type)
                        @if($vehicle->type != null)
                          @if($type->name != $vehicle->type->name)
                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                          @endif
                        @else
                          <option value="{{ $type->name }}">{{ $type->name }}</option>
                        @endif
                    @endforeach
                    @if($vehicle->type != null)
                      <option value="">N/A</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="fuelType" class="control-label col-sm-3">Fuel Type</label>
                <div class="col-sm-9">
                  <select id="fuelType" class="form-control" name="fuelType">
                    <option value="{{ $vehicle->fuelType != null ? $vehicle->fuelType->name : '' }}" selected>{{ $vehicle->fuelType != null ? $vehicle->fuelType->name : 'N/A' }}</option>
                    @foreach($fuelTypes as $fuelType)
                        @if($vehicle->fuelType != null)
                          @if($fuelType->name != $vehicle->fuelType->name)
                            <option value="{{ $fuelType->name }}">{{ $fuelType->name }}</option>
                          @endif
                        @else
                          <option value="{{ $fuelType->name }}">{{ $fuelType->name }}</option>
                        @endif
                    @endforeach
                    @if($vehicle->fuelType != null)
                      <option value="">N/A</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="gearType" class="control-label col-sm-3">Gear Type</label>
                <div class="col-sm-9">
                  <select id="gearType" class="form-control" name="gearType">
                    <option value="{{ $vehicle->gearType != null ? $vehicle->gearType->name : '' }}" selected>{{ $vehicle->gearType != null ? $vehicle->gearType->name : 'N/A' }}</option>
                    @foreach($gearTypes as $gearType)
                        @if($vehicle->gearType != null)
                          @if($gearType->name != $vehicle->gearType->name)
                            <option value="{{ $gearType->name }}">{{ $gearType->name }}</option>
                          @endif
                        @else
                          <option value="{{ $gearType->name }}">{{ $gearType->name }}</option>
                        @endif
                    @endforeach
                    @if($vehicle->gearType != null)
                      <option value="">N/A</option>
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group{{ $errors->hasBag('edit') ? ' has-error' : '' }}">
                <label for="vehicle_images_add" class="control-label col-sm-3">Add Images</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" name="vehicle_images_add[]" id="vehicle_images_add" value="{{ $vehicle->image_path }}" data-multiple-caption="{count} files selected" multiple>
                  @if($errors->hasBag('edit') and $errors->edit->has('vehicle_images_add.*'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ array_values($errors->edit->get('vehicle_images_add.*'))[0][0] }}</strong><br>
                        {{ array_values($errors->edit->get('vehicle_images_add.*'))[0][1] }}
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
              @if($vehicle->images->isNotEmpty())
                <div class="form-group">
                  <label for="vehicle_images_del" class="control-label col-sm-3">Delete Images</label>
                  <div class="col-sm-9">
                    <select multiple class="form-control" name="vehicle_images_del[]" id="vehicle_images_del">
                      @foreach($vehicle->images as $image)
                        <option value="{{ $image->name }}">{{ $image->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-9 col-sm-offset-3">
            <div class="btn-group">
              <button type="submit" form="vehicle_edit_form" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
              <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->slug]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection