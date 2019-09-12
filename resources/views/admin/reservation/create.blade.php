<div class="panel panel-default">
  <div class="panel-heading">
    <h3>Book reservation</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" action="{{ route('admin.reservations.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="vehicle_id" class="col-sm-4 control-label">Vehicle*</label>
        <div class="col-sm-8">
          <select id="vehicle_id" class="form-control" name="vehicle_id">
            @foreach($vehicles as $vehicle)
              <option value="{{ $vehicle->id }}" {{ old("vehicle_id") == $vehicle->id ? "selected" : "" }}>{{ $vehicle->full_name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group{{ $errors->reservations->has('start_date') ? ' has-error' : '' }}">
        <label for="start_date" class="col-sm-4 control-label">Start Date*</label>
        <div class="col-sm-8">
          <div class="input-group">
            {{ Form::text('start_date', '', array(
              'class' => 'form-control', 'autocomplete' => 'off',
              'placeholder' => 'Start date...', 'id' => 'start_date', 'readonly' => 'readonly'))
            }}
            <span class="input-group-addon" id="start_date_calender"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
          @if( $errors->reservations->has('start_date'))
            @include('admin.common.alert-danger', ['error' => $errors->reservations->first('start_date')])
          @endif
        </div>
      </div>
      <div class="form-group{{ $errors->reservations->has('end_date') ? ' has-error' : '' }}">
        <label for="end_date" class="col-sm-4 control-label">End Date*</label>
        <div class="col-sm-8">
          <div class="input-group">
            {{ Form::text('end_date', '', array(
              'class' => 'form-control', 'autocomplete' => 'off',
              'placeholder' => 'End date...',
              'id' => 'end_date', 'readonly' => 'readonly'))
            }}
            <span class="input-group-addon" id="end_date_calender"><span class="glyphicon glyphicon-calendar"></span></span>
          </div>
          @if( $errors->reservations->has('end_date'))
            @include('admin.common.alert-danger', ['error' => $errors->reservations->first('end_date')])
          @endif
        </div>
      </div>
      @if( $errors->reservations->has('reservation') or $errors->reservations->has('hire'))
        <div class="form-group has-error">
          <div class="col-md-8 col-md-offset-4">
            <div class="alert alert-danger" role="alert">
              <div class="help-block">
                @if($errors->reservations->has('reservation'))
                  <div class="row">
                    <div class="col-md-12">
                      <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                      <strong>Start date = {{ $errors->reservations->get('reservation')['start_date'] }}</strong><br>
                      <strong>End date = {{ $errors->reservations->get('reservation')['end_date'] }}</strong>
                    </div>
                  </div>
                @endif
                @if( $errors->reservations->has('reservation') and $errors->reservations->has('hire'))
                  <hr>
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
        <div class="col-sm-4 col-sm-offset-4">
          <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;Book reservation</button>
        </div>
      </div>
    </form>
  </div>
</div>
