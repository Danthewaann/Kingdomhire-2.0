@extends('layouts.admin-vehicle-dashboard')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="well">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2 style="padding-left: 5px">Edit active hire</h2>
        </div>
        <div class="panel-body">
          <form action="{{ route('admin.vehicle.hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-row">
              <div class="form-group{{ $errors->hires->has('name') ? ' has-error' : '' }}">
                <div class="form-row">
                  <label for="name">ID</label>
                  {{ Form::text('name', $hire->name, array('class' => 'form-control', 'autocomplete' => 'off')) }}
                  @if( $errors->hires->has('name'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->hires->first('name') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->hires->has('start_date') ? ' has-error' : '' }}">
                <div class="form-row">
                  <label for="start_date_readonly">Start Date <small>(can't change)</small></label>
                  <div class="input-group">
                    <input id="start_date_readonly" class="form-control" type="text" name="start_date" value="{{ $hire->start_date }}" readonly/>
                    <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                  @if( $errors->hires->has('start_date'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->hires->first('start_date') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->hires->has('end_date') ? ' has-error' : '' }}">
                <div class="form-row">
                  <label for="end_date">End Date*</label>
                  <div class="input-group">
                    {{ Form::text('end_date', $hire->end_date, array(
                      'class' => 'form-control datepicker', 'autocomplete' => 'off',
                      'placeholder' => 'e.g. '.date('Y-m-d', strtotime(date('Y-m-d') . ' +3 days')), 'id' => 'end_date'))
                    }}
                    <span class="input-group-addon" id="end_date_calender"> <span class="glyphicon glyphicon-calendar"></span></span>
                  </div>
                  @if( $errors->hires->has('end_date'))
                    <div class="help-block">
                      <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> <strong>{{ $errors->hires->first('end_date') }}</strong>
                      </div>
                    </div>
                  @endif
                </div>
              </div>
              @if( $errors->hires->has('reservation') or $errors->hires->has('hire'))
                <div class="form-group has-error">
                  <div class="form-row">
                    <div class="alert alert-danger" role="alert">
                      <div class="help-block">
                        <div class="row">
                          @if($errors->hires->has('reservation'))
                            <div class="col-md-6">
                              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                              <strong>Start date = {{ $errors->hires->get('reservation')['start_date'] }}</strong><br>
                              <strong>End date = {{ $errors->hires->get('reservation')['end_date'] }}</strong>
                            </div>
                          @endif
                          @if($errors->hires->has('hire'))
                            <div class="col-md-6">
                              <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Current active hire</strong><br>
                              <strong>Start date = {{ $errors->hires->get('hire')['start_date'] }}</strong><br>
                              <strong>End date = {{ $errors->hires->get('hire')['end_date'] }}</strong>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
              <div class="form-row">
                <div class="row">
                  <div class="col-xs-12">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                      <a href="{{ route('admin.vehicle.home', ['id' => $vehicle->id]) }}" class="btn btn-info"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection