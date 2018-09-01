<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Book reservation</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" action="{{ route('admin.reservations.store') }}" method="post">
      @csrf
      <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
      <div class="form-group{{ $errors->reservations->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-sm-3 control-label">ID</label>
        <div class="col-sm-9">
          <div class="input-group">
            {{ Form::text('name', '', array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter ID')) }}
            <div class="input-group-btn">
              <a class="btn btn-info" role="button" data-trigger="focus" data-container="body" tabindex="0"
                 data-toggle="popover" data-placement="top"
                 data-content="ID is just a way for you to easily distinguish each reservation. Use the initials of whoever
                           is making the reservation e.g. DB">
                <span class="glyphicon glyphicon-info-sign"></span>
              </a>
            </div>
          </div>
          @if( $errors->reservations->has('name'))
            <div class="help-block">
              <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->reservations->first('name') }}</strong>
              </div>
            </div>
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->reservations->has('start_date') ? ' has-error' : '' }}">
        <label for="start_date" class="col-sm-3 control-label">Start Date*</label>
        <div class="col-sm-9">
          <div class="input-group">
            {{ Form::text('start_date', '', array(
              'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'e.g. '.date('Y-m-d'), 'id' => 'start_date'))
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
        <label for="end_date" class="col-sm-3 control-label">End Date*</label>
        <div class="col-sm-9">
          <div class="input-group">
            {{ Form::text('end_date', '', array(
              'class' => 'form-control', 'autocomplete' => 'off',
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
      @if( $errors->reservations->has('reservation') or $errors->reservations->has('hire'))
        <div class="form-group has-error">
          <div class="col-md-9 col-md-offset-3">
            <div class="alert alert-danger" role="alert">
              <div class="help-block">
                @if($errors->reservations->has('reservation'))
                  <div class="row">
                    <div class="col-md-12" style="margin: 5px 0 5px 0">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                      <strong>Start date = {{ $errors->reservations->get('reservation')['start_date'] }}</strong><br>
                      <strong>End date = {{ $errors->reservations->get('reservation')['end_date'] }}</strong>
                    </div>
                  </div>
                @endif
                @if($errors->reservations->has('hire'))
                  <div class="row">
                    <div class="col-md-12" style="margin: 5px 0 5px 0">
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
        <div class="col-sm-6 col-sm-offset-3">
          <div class="btn-group">
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Book reservation</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
