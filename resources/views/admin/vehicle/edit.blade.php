@extends('layouts.admin-main')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading"><h3>Edit {{ $vehicle->name() }}</h3></div>
  <div class="panel-body">
    <form action="{{ route('vehicle.edit', ['make' => $vehicle->make, 'model' => $vehicle->model, 'id' => $vehicle->id]) }}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-row">
        <div class="form-group col-xs-6">
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
        <div class="form-group col-xs-6">
          <label for="vehicle_image">Vehicle Image</label>
          <input type="file" class="form-control" name="vehicle_image" id="vehicle_image" value="{{ $vehicle->image_path }}" multiple>
        </div>
      </div>
      <div class="form-row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary">Edit Vehicle</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
