<form action="{{ url('admin/logHire') }}" method="post">
    {{csrf_field()}}
    <div class="form-row">
        <div class="col-xs-12">
            <h3>Log a vehicle hire</h3>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="vehicle">Vehicle</label>
            <select id="vehicle" class="form-control" name="vehicle">
                @foreach($vehicles as $vehicle)
                    <option>{{ $vehicle->make }} {{ $vehicle->model }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary">Log Hire</button>
            </div>
        </div>
    </div>
</form>