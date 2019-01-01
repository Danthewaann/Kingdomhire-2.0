<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Create vehicle</h3>
  </div>
  <div class="panel-body">
    <form action="{{ route('admin.vehicles.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group{{ $errors->has('make') ? ' has-error' : '' }}">
                <label for="make">Make*</label>
                <input type="text" class="form-control" id="make" name="make" value="{{ old('make') }}" autocomplete="off" placeholder="Enter make">
                @if( $errors->has('make'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('make') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                <label for="model">Model*</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" autocomplete="off" placeholder="Enter model">
                @if( $errors->has('model'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('model') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
              <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }}">
                <label for="seats">Seats*</label>
                <input type="number" class="form-control" id="seats" name="seats" placeholder="Enter number of seats" value="{{ old('seats') }}" autocomplete="off">
                @if( $errors->has('seats'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('seats') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
              <div class="form-group">
                <label for="rate_name">Weekly Rate*</label>
                <select id="rate_name" class="form-control" name="rate_name">
                  @foreach($rates as $rate)
                    <option value="{{ $rate->name }}">{{ $rate->getFullname() }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="type">Vehicle Type*</label>
                <select id="type" class="form-control" name="type">
                  @foreach($types as $type)
                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="fuel_type">Fuel Type*</label>
                <select id="fuel_type" class="form-control" name="fuel_type">
                  @foreach($fuelTypes as $type)
                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="gear_type">Gear Type*</label>
                <select id="gear_type" class="form-control" name="gear_type">
                  @foreach($gearTypes as $type)
                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group{{ $errors->has('vehicle_images') ? ' has-error' : '' }}">
                <label for="vehicle_image">Image(s)</label>
                <input type="file" class="form-control" name="vehicle_images[]" id="vehicle_image" multiple>
                @if( $errors->has('vehicle_images'))
                  <div class="help-block">
                    <div class="alert alert-danger" role="alert">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('vehicle_images') }}</strong>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Create</button>
        </div>
      </div>
    </form>
  </div>
</div>
