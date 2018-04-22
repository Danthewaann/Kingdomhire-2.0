<form action="{{ url('admin/reservations/delete') }}" method="post">
    {{csrf_field()}}
    <div class="form-row">
        <div class="col-xs-12">
            <h3>Delete a reservation</h3>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="reservation">Reservation Id</label>
            <select id="reservation" class="form-control" name="reservation">
                @foreach($reservations as $reservation)
                    <option>{{ $reservation->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary">Delete Reservation</button>
            </div>
        </div>
    </div>
</form>
