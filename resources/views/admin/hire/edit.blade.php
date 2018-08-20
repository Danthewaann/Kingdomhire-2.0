@extends('layouts.admin-main')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">
      <div class="well">
        <h2 style="text-align: center">Vehicle Dashboard</h2>
        <h4 style="text-align: center">{{ $vehicle->name() }}</h4>
      </div>
      @include('admin.vehicle.dashboard-summary')
    </div>
    <div class="col-md-9">
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="row">
          <div class="well">
            <h3>Edit active hire</h3>
            <form action="{{ route('admin.vehicle.hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}" method="post">
              @csrf
              @method('PATCH')
              <div class="form-row">
                <div class="form-group{{ $errors->hires->has('made_by') ? ' has-error' : '' }}">
                  <div class="form-row">
                    <label for="made_by">Hired By*</label>
                    {{ Form::text('hired_by', $hire->hired_by, array('class' => 'form-control', 'autocomplete' => 'off')) }}
                    @if( $errors->hires->has('hired_by'))
                      <div class="help-block">
                        <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->hires->first('hired_by') }}</strong>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->hires->has('start_date') ? ' has-error' : '' }}">
                  <div class="form-row">
                    <label for="start_date_readonly">Start Date*</label>
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
                <div class="form-group{{ $errors->hires->has('rate') ? ' has-error' : '' }}">
                  <div class="form-row">
                    <label for="rate">Rate</label>
                    <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-gbp"></span></span>
                      {{ Form::text('rate', $hire->rate, array('class' => 'form-control', 'autocomplete' => 'off', 'aria-label' => 'Amount (to the nearest pound)')) }}
                    </div>
                    @if( $errors->hires->has('rate'))
                      <div class="help-block">
                        <div class="alert alert-danger" role="alert">
                          <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->hires->first('rate') }}</strong>
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
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                        <a href="{{ route('admin.vehicle.home', ['id' => $vehicle->id]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
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
</div>
@endsection