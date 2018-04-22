<div class="panel panel-default">
  <div class="panel-heading"><h3>Add A Vehicle</h3></div>
  <div class="panel-body">
  <form action="{{ route('vehicle.add') }}" method="post" enctype="multipart/form-data">
      {{csrf_field()}}
      <div class="form-row">
          <div class="form-group col-xs-6">
              <label for="make">Vehicle Make</label>
              <input type="text" class="form-control" id="make" name="make" placeholder="Enter make" required>
          </div>
          <div class="form-group col-xs-6">
              <label for="model">Vehicle Model</label>
              <input type="text" class="form-control" id="model" name="model" placeholder="Enter model" required>
          </div>
      </div>
      <div class="form-row">
          <div class="form-group col-xs-6">
              <label for="fuel_type">Vehicle Fuel Type</label>
              <select id="fuel_type" class="form-control" name="fuel_type" required>
                  <option selected>Petrol</option>
                  <option>Diesel</option>
              </select>
          </div>
          <div class="form-group col-xs-6">
              <label for="gear_type">Vehicle Gear Type</label>
              <select id="gear_type" class="form-control" name="gear_type" required>
                  <option selected>Manuel</option>
                  <option>Automatic</option>
                  <option>Manuel & Automatic</option>
              </select>
          </div>
      </div>
      <div class="form-row">
          <div class="form-group col-xs-6">
              <label for="seats">Vehicle Seats</label>
              <input type="text" class="form-control" id="seats" name="seats" placeholder="Enter number of seats" required>
          </div>
          <div class="form-group col-xs-6">
              <label for="type">Vehicle Type</label>
              <select id="type" class="form-control" name="type" required>
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
              <select id="engine_size" class="form-control" name="engine_size" required>
                @foreach($rates as $rate)
                  <option value="{{ $rate->engine_size }}">{{ $rate->engine_size }} (£{{ $rate->weekly_rate_min }}-£{{ $rate->weekly_rate_max }})</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-xs-6">
              <label for="vehicle_image">Vehicle Image (optional)</label>
              <input type="file" class="form-control" name="vehicle_image" id="vehicle_image">
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
