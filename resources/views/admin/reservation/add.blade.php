<h3>Book reservation</h3>
<form action="{{ route('reservation.log', ['id' => $vehicle->id]) }}" method="post">
  @csrf
  <div class="form-row">
    <input id="vehicle" class="form-control" type="hidden" value="{{ $vehicle->name() }}" disabled/>
    <div class="form-group{{ $errors->has('made_by') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="made_by">Made By*</label>
        {{ Form::text('made_by', '', array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter name')) }}
        @if( $errors->has('made_by'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('made_by') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="start_date">Start Date*</label>
        <div class="input-group">
          {{ Form::text('start_date', '', array(
            'class' => 'form-control datepicker', 'autocomplete' => 'off', 'placeholder' => 'e.g. '.date('Y-m-d'), 'id' => 'start_date'))
          }}
          <span class="input-group-addon" id="start_date_calender"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        @if( $errors->has('start_date'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('start_date') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="end_date">End Date*</label>
          <div class="input-group">
            {{ Form::text('end_date', '', array(
              'class' => 'form-control datepicker', 'autocomplete' => 'off',
              'placeholder' => 'e.g. '.date('Y-m-d', strtotime(date('Y-m-d') . ' +3 days')), 'id' => 'end_date'))
            }}
            <span class="input-group-addon" id="end_date_calender"> <span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        @if( $errors->has('end_date'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('end_date') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="rate">Rate</label>
        <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
          {{ Form::text('rate', '', array('class' => 'form-control', 'autocomplete' => 'off', 'aria-label' => 'Amount (to the nearest pound)')) }}
        </div>
        @if( $errors->has('rate'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->first('rate') }}</strong>
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
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Book Reservation</button>
    </div>
  </div>
</form>
