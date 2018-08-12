<div class="col-md-12">
  <h2>Edit {{ $vehicle->name() }}</h2>
</div>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-4 col-xs-12">
      <form action="{{ route('vehicle.edit', ['id' => $vehicle->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="form-group">
            <label for="rate_name">Weekly Rate</label>
            <select id="rate_name" class="form-control" name="rate_name">
              @if($vehicle->rate != null)
                <option value="{{ $vehicle->rate->name }}">{{ $vehicle->rate->name }} (£{{ $vehicle->rate->weekly_rate_min }}-£{{ $vehicle->rate->weekly_rate_max }})</option>
              @else
                <option value="">N/A</option>
              @endif
              @foreach($rates as $rate)
                  @if($vehicle->rate != null)
                    @if($rate->name != $vehicle->rate->name)
                      <option value="{{ $rate->name }}">{{ $rate->name }} (£{{ $rate->weekly_rate_min }}-£{{ $rate->weekly_rate_max }})</option>
                    @endif
                  @else
                    <option value="{{ $rate->name }}">{{ $rate->name }} (£{{ $rate->weekly_rate_min }}-£{{ $rate->weekly_rate_max }})</option>
                  @endif
              @endforeach
            </select>
          </div>
        @if(!$vehicle->images->isEmpty())
          <div class="form-group">
            <label for="vehicle_images_del">Delete Images</label>
            <select multiple class="form-control" name="vehicle_images_del[]" id="vehicle_images_del">
              @foreach($vehicle->images as $image)
                <option value="{{ $image->name }}">{{ $image->name }}</option>
              @endforeach
            </select>
          </div>
        @endif
          <div class="form-group">
            <label for="vehicle_images_add">Add Images</label>
            <input type="file" name="vehicle_images_add[]" id="vehicle_images_add" value="{{ $vehicle->image_path }}" multiple>
          </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp;&nbsp;Update</button>
        </div>
      </form>
    </div>
    <div class="col-md-8 col-xs-12">
      <div class="row">
      @foreach($vehicle->images as $image)
        <div class="col-md-3 col-sm-6 col-xs-12">
          <img src="{{ $image->image_uri }}" style="width: 100%; height: 150px"/>
          <table class="table">
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
