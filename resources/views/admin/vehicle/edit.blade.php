@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="col-md-12">
  <div class="row">
    @if(!empty(session()->get('status')['edit']))
      <div class="alert alert-success" style="margin-top: 22px">
        <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ session()->get('status')['edit'] }}
      </div>
    @endif
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Edit vehicle</h3>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-5 col-md-12 col-xs-12">
            <form action="{{ route('admin.vehicles.update', ['vehicle' => $vehicle->slug]) }}" method="post" enctype="multipart/form-data" id="vehicle_edit_form">
              @csrf
              @method('PATCH')
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="vehicle_status">Status</label>
                    @if($vehicle->status == 'Out for hire')
                      <input type="text" id="vehicle_status" class="form-control" disabled value="{{ $vehicle->status }}">
                    @else
                    <select id="vehicle_status" class="form-control" name="vehicle_status">
                      <option value="{{ $vehicle->status }}">{{ $vehicle->status }}</option>
                      @if($vehicle->status == 'Available')
                        <option value="Unavailable">Unavailable</option>
                      @else
                        <option value="Available">Available</option>
                      @endif
                    </select>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="vehicle_type">Vehicle Type</label>
                    <select id="vehicle_type" class="form-control" name="vehicle_type">
                      @if($vehicle->type != null)
                        <option value="{{ $vehicle->type->name }}">{{ $vehicle->type->name }}</option>
                      @else
                        <option value="">N/A</option>
                      @endif
                      @foreach($types as $type)
                          @if($vehicle->type != null)
                            @if($type->name != $vehicle->type->name)
                              <option value="{{ $type->name }}">{{ $type->name }}</option>
                            @endif
                          @else
                            <option value="{{ $type->name }}">{{ $type->name }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="fuel_type">Fuel Type</label>
                    <select id="fuel_type" class="form-control" name="fuel_type">
                      @if($vehicle->fuelType != null)
                        <option value="{{ $vehicle->fuelType->name }}">{{ $vehicle->fuelType->name }}</option>
                      @else
                        <option value="">N/A</option>
                      @endif
                      @foreach($fuelTypes as $fuelType)
                          @if($vehicle->fuelType != null)
                            @if($fuelType->name != $vehicle->fuelType->name)
                              <option value="{{ $fuelType->name }}">{{ $fuelType->name }}</option>
                            @endif
                          @else
                            <option value="{{ $fuelType->name }}">{{ $fuelType->name }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="gear_type">Gear Type</label>
                    <select id="gear_type" class="form-control" name="gear_type">
                      @if($vehicle->gearType != null)
                        <option value="{{ $vehicle->gearType->name }}">{{ $vehicle->gearType->name }}</option>
                      @else
                        <option value="">N/A</option>
                      @endif
                      @foreach($gearTypes as $gearType)
                          @if($vehicle->gearType != null)
                            @if($gearType->name != $vehicle->gearType->name)
                              <option value="{{ $gearType->name }}">{{ $gearType->name }}</option>
                            @endif
                          @else
                            <option value="{{ $gearType->name }}">{{ $gearType->name }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="weekly_rate">Weekly Rate</label>
                    <select id="weekly_rate" class="form-control" name="weekly_rate">
                      @if($vehicle->rate != null)
                        <option value="{{ $vehicle->rate->name }}">{{ $vehicle->rate->getFullName() }}</option>
                      @else
                        <option value="">N/A</option>
                      @endif
                      @foreach($rates as $rate)
                          @if($vehicle->rate != null)
                            @if($rate->name != $vehicle->rate->name)
                              <option value="{{ $rate->name }}">{{ $rate->getFullName() }}</option>
                            @endif
                          @else
                            <option value="{{ $rate->name }}">{{ $rate->getFullName() }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group{{ $errors->hasBag('edit') ? ' has-error' : '' }}">
                    <label for="vehicle_images_add">Add Images</label>
                    <input type="file" class="form-control" name="vehicle_images_add[]" id="vehicle_images_add" value="{{ $vehicle->image_path }}" data-multiple-caption="{count} files selected" multiple>
                    @if($errors->hasBag('edit') and $errors->edit->has('vehicle_images_add'))
                      <div class="help-block">
                        <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->edit->first('vehicle_images_add') }}</strong>
                        </div>
                      </div>
                    @endif
                  </div>
                  @if($vehicle->images->isNotEmpty())
                    <div class="form-group">
                      <label for="vehicle_images_del">Delete Images</label>
                      <select multiple class="form-control" name="vehicle_images_del[]" id="vehicle_images_del">
                        @foreach($vehicle->images as $image)
                          <option value="{{ $image->name }}">{{ $image->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  @endif
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-xs-12">
                <div class="btn-group">
                  <button type="submit" form="vehicle_edit_form" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  <a href="{{ route('admin.vehicles.show', ['vehicle' => $vehicle->slug]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-md-12 col-xs-12">
            <div class="row">
            @foreach($vehicle->images as $image)
              <div class="col-lg-6 col-md-6 col-sm-12" style="margin-top: 22px">
                <img src="{{ $image->image_uri }}" style="width: 100%;"/>
                <table class="table table-condensed">
                  <tr>
                    <td class="last">{{ $image->name }}</td>
                  </tr>
                </table>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
