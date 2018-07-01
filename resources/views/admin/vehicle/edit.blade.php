@extends('layouts.admin-main')

@section('content')
@include('admin.vehicle.navbar')
<div class="row">
  <div class="col-md-3 col-sm-4 col-xs-12">
    @include('admin.vehicle.summary')
  </div>
  <div class="col-md-6 col-sm-8 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading"><h3>Edit</h3></div>
      <div class="panel-body">
        <div class="col-md-6">
          <form action="{{ route('vehicle.edit', ['id' => $vehicle->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
              <div class="form-group row col-xs-12">
                <label for="engine_size">Engine Size</label>
                <select id="engine_size" class="form-control" name="engine_size">
                  @if($vehicle->rate != null)
                    <option value="{{ $vehicle->rate->engine_size }}">{{ $vehicle->rate->engine_size }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</option>
                  @endif
                  @foreach($rates as $rate)
                      @if($vehicle->rate != null)
                        @if($rate->engine_size != $vehicle->rate->engine_size)
                          <option value="{{ $rate->engine_size }}">{{ $rate->engine_size }} (£{{ $rate->weekly_rate_min }}-£{{ $rate->weekly_rate_max }})</option>
                        @endif
                      @else
                        <option value="{{ $rate->engine_size }}">{{ $rate->engine_size }} (£{{ $rate->weekly_rate_min }}-£{{ $rate->weekly_rate_max }})</option>
                      @endif
                  @endforeach
                </select>
              </div>
            @if(!$vehicle->images->isEmpty())
              <div class="form-group row col-xs-12">
                <label for="vehicle_images_del">Delete Images (hold shift to select more than one)</label>
                <select multiple class="form-control" name="vehicle_images_del[]" id="vehicle_images_del">
                  @foreach($vehicle->images as $image)
                    <option>{{ $image->name }}</option>
                  @endforeach
                </select>
              </div>
            @endif
              <div class="form-group row col-xs-12">
                <label for="vehicle_images_add">Add Images</label>
                <input type="file" class="form-control" name="vehicle_images_add[]" id="vehicle_images_add" value="{{ $vehicle->image_path }}" multiple>
              </div>
            <div class="form-group row col-xs-12">
              <button type="submit" class="btn btn-primary">Edit Vehicle</button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          @foreach($vehicle->images as $image)
            <div style="width: 210px; display: inline-block; padding: 10px;">
              <img src="{{ $image->image_uri }}" style="width: 100%; height: 125px;"/>
              <table class="table">
                <tr>
                  <th>{{ $image->name }}</th>
                </tr>
              </table>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection
