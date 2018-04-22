<form action="{{ url('admin/vehicles/delete') }}" method="post">
    {{csrf_field()}}
    <div class="form-row">
        <div class="col-xs-12">
            <h3>Delete a vehicle</h3>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="delete">Vehicle</label>
            <select id="delete" class="form-control" name="delete">
                @foreach($vehicles as $vehicle)
                    <option>{{ $vehicle->make }} {{ $vehicle->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary">Delete Vehicle</button>
            </div>
        </div>
    </div>
</form>
