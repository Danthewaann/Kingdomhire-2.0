<h2>Log a reservation</h2>
<form action="{{ route('reservation.log', ['id' => $vehicle->id]) }}" method="post">
  @csrf
  <div class="form-row">
    <input id="vehicle" class="form-control" type="hidden" value="{{ $vehicle->name() }}" disabled/>
    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="start_date">Start Date</label>
        {{ Form::text('start_date', '', array('class' => 'form-control datepicker', 'autocomplete' => 'off')) }}
        @if( $errors->has('start_date'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>{{ $errors->first('start_date') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="end_date">End Date</label>
        {{ Form::text('end_date', '', array('class' => 'form-control datepicker', 'autocomplete' => 'off')) }}
        @if( $errors->has('end_date'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>{{ $errors->first('end_date') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    @if( $errors->has('reservation') or $errors->has('hire'))
      <div class="form-group has-error">
        <div class="form-row">
          <div class="alert alert-danger" role="alert">
            <span class="help-block">
              @if($errors->has('reservation'))
                <strong>Other reservation</strong><br>
                <strong>Start date = {{ $errors->get('reservation')['start_date'] }}</strong><br>
                <strong>End date = {{ $errors->get('reservation')['end_date'] }}</strong>
                <br><br>
              @endif
              @if($errors->has('hire'))
                <strong>Current active hire</strong><br>
                <strong>Start date = {{ $errors->get('hire')['start_date'] }}</strong><br>
                <strong>End date = {{ $errors->get('hire')['end_date'] }}</strong>
              @endif
            </span>
          </div>
        </div>
      </div>
    @endif
    <div class="form-row">
      <button type="submit" class="btn btn-info">Log Reservation</button>
    </div>
  </div>
</form>
