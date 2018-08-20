<h3>Book reservation</h3>
<form action="{{ route('admin.vehicle.reservation.add', ['id' => $vehicle->id]) }}" method="post">
  @csrf
  <div class="form-row">
    <div class="form-group{{ $errors->reservations->has('made_by') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="made_by">Made By*</label>
        {{ Form::text('made_by', '', array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter name')) }}
        @if( $errors->reservations->has('made_by'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->reservations->first('made_by') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->reservations->has('start_date') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="start_date">Start Date*</label>
        <div class="input-group">
          {{ Form::text('start_date', '', array(
            'class' => 'form-control datepicker', 'autocomplete' => 'off', 'placeholder' => 'e.g. '.date('Y-m-d'), 'id' => 'start_date'))
          }}
          <span class="input-group-addon" id="start_date_calender"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        @if( $errors->reservations->has('start_date'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->reservations->first('start_date') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->reservations->has('end_date') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="end_date">End Date*</label>
          <div class="input-group">
            {{ Form::text('end_date', '', array(
              'class' => 'form-control datepicker', 'autocomplete' => 'off',
              'placeholder' => 'e.g. '.date('Y-m-d', strtotime(date('Y-m-d') . ' +3 days')), 'id' => 'end_date'))
            }}
            <span class="input-group-addon" id="end_date_calender"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
        @if( $errors->reservations->has('end_date'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->reservations->first('end_date') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    <div class="form-group{{ $errors->reservations->has('rate') ? ' has-error' : '' }}">
      <div class="form-row">
        <label for="rate">Rate</label>
        <div class="input-group">
          <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
          {{ Form::text('rate', '', array('class' => 'form-control', 'autocomplete' => 'off', 'aria-label' => 'Amount (to the nearest pound)')) }}
        </div>
        @if( $errors->reservations->has('rate'))
          <div class="help-block">
            <div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->reservations->first('rate') }}</strong>
            </div>
          </div>
        @endif
      </div>
    </div>
    @if( $errors->reservations->has('reservation') or $errors->reservations->has('hire'))
      <div class="form-group has-error">
        <div class="form-row">
          <div class="alert alert-danger" role="alert">
            <div class="help-block">
              <div class="row">
                @if($errors->reservations->has('reservation'))
                  <div class="col-md-6">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                    <strong>Start date = {{ $errors->reservations->get('reservation')['start_date'] }}</strong><br>
                    <strong>End date = {{ $errors->reservations->get('reservation')['end_date'] }}</strong>
                  </div>
                @endif
                @if($errors->reservations->has('hire'))
                  <div class="col-md-6">
                    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Current active hire</strong><br>
                    <strong>Start date = {{ $errors->reservations->get('hire')['start_date'] }}</strong><br>
                    <strong>End date = {{ $errors->reservations->get('hire')['end_date'] }}</strong>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    <div class="row">
      <div class="col-md-5 col-sm-7 col-xs-12">
        <div class="btn-group btn-group-justified">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Book Reservation</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
