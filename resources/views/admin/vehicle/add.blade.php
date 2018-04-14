<form action="{{url('admin/addVehicle')}}" method="post">
    {{csrf_field()}}
    <div class="form-row">
        <div class="col-xs-12">
            <h3>Add a vehicle</h3>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="make">Vehicle Make</label>
            <input type="text" class="form-control" id="make" name="make" placeholder="Enter make">
        </div>
        <div class="form-group col-xs-6">
            <label for="model">Vehicle Model</label>
            <input type="text" class="form-control" id="model" name="model" placeholder="Enter model">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="fuel_type">Vehicle Fuel Type</label>
            <select id="fuel_type" class="form-control" name="fuel_type">
                <option selected>Petrol</option>
                <option>Diesel</option>
            </select>
        </div>
        <div class="form-group col-xs-6">
            <label for="gear_type">Vehicle Gear Type</label>
            <select id="gear_type" class="form-control" name="gear_type">
                <option selected>Manuel</option>
                <option>Automatic</option>
                <option>Manuel & Automatic</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="seats">Vehicle Seats</label>
            <input type="text" class="form-control" id="seats" name="seats" placeholder="Enter number of seats">
        </div>
        <div class="form-group col-xs-6">
            <label for="type">Vehicle Type</label>
            <select id="type" class="form-control" name="type">
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
            <select id="engine_size" class="form-control" name="engine_size">
                <option selected>Small</option>
                <option>Medium</option>
                <option>Large</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
        </div>
    </div>
</form>
