<h2>Edit vehicle</h2>
<div class="col-md-6">
  <div class="row">
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
          <label for="vehicle_images_del">Delete Images</label>
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
        <button type="submit" class="btn btn-info">Edit Vehicle</button>
      </div>
    </form>
  </div>
</div>
<div class="col-md-6">
  <div class="row">
    @foreach($vehicle->images as $image)
      <div style="width: 210px; display: inline-block; padding: 10px;">
        <img src="{{ $image->image_uri }}" style="width: 100%; height: 125px;"/>
        <table class="table vehicle-summary">
          <tr>
            <th>{{ $image->name }}</th>
          </tr>
        </table>
      </div>
    @endforeach
  </div>
</div>
