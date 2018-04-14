<form action="{{ url('admin/deleteHire') }}" method="post">
    {{csrf_field()}}
    <div class="form-row">
        <div class="col-xs-12">
            <h3>Delete a hire</h3>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-xs-6">
            <label for="hire">Hire Id</label>
            <select id="hire" class="form-control" name="hire">
                @foreach($hires as $hire)
                    <option>{{ $hire->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary">Delete Hire</button>
            </div>
        </div>
    </div>
</form>
