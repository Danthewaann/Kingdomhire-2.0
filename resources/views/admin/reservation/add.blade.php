<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Book reservation</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" action="{{ route('admin.vehicle.reservation.add', ['id' => $vehicle->id]) }}" method="post">
      @csrf
      <div class="form-group{{ $errors->reservations->has('made_by') ? ' has-error' : '' }}">
        <label for="made_by" class="col-md-3 control-label">Made By*</label>
        <div class="col-md-9">
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
        <label for="start_date" class="col-md-3 control-label">Start Date*</label>
        <div class="col-md-9">
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
        <label for="end_date" class="col-md-3 control-label">End Date*</label>
        <div class="col-md-9">
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
        <label for="rate" class="col-md-3 control-label">Rate</label>
        <div class="col-md-9">
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
          <div class="col-md-9 col-md-offset-3">
            <div class="alert alert-danger" role="alert">
              <div class="help-block">
                @if($errors->reservations->has('reservation'))
                  <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                      <strong>Start date = {{ $errors->reservations->get('reservation')['start_date'] }}</strong><br>
                      <strong>End date = {{ $errors->reservations->get('reservation')['end_date'] }}</strong>
                    </div>
                  </div>
                @endif
                @if($errors->reservations->has('hire'))
                  <div class="row">
                    <div class="col-md-12">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Current active hire</strong><br>
                      <strong>Start date = {{ $errors->reservations->get('hire')['start_date'] }}</strong><br>
                      <strong>End date = {{ $errors->reservations->get('hire')['end_date'] }}</strong>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-md-6 col-xs-6 col-md-offset-3">
          <div class="btn-group">
            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Book Reservation</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
