@extends('layouts.admin-main')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        @include('admin.vehicle.dashboard-summary')
      </div>
      <div class="col-md-9">
        <div class="col-md-4 col-sm-12 col-xs-12">
          <div class="row">
            <div class="well">
              <h3>Edit past hire</h3>
              <form action="{{ route('admin.vehicle.hire.edit', ['vehicle_id' => $vehicle->id, 'hire_id' => $hire->id]) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="form-row">
                  <div class="form-group{{ $errors->has('made_by') ? ' has-error' : '' }}">
                    <div class="form-row">
                      <label for="hired_by">Hired By*</label>
                      <input id="hired_by" class="form-control" type="text" value="{{ $hire->hired_by }}" readonly/>
                      @if( $errors->has('hired_by'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('hired_by') }}</strong>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    <div class="form-row">
                      <label for="start_date_readonly">Start Date*</label>
                      <div class="input-group">
                        <input id="start_date_readonly" class="form-control" type="text" value="{{ $hire->start_date }}" readonly/>
                        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
                      </div>
                      @if( $errors->has('start_date'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('start_date') }}</strong>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                    <div class="form-row">
                      <label for="end_date_readonly">End Date*</label>
                      <div class="input-group">
                        <input id="end_date_readonly" class="form-control" type="text" value="{{ $hire->end_date }}" readonly/>
                        <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span></span>
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
                        {{ Form::text('rate', $hire->rate, array('class' => 'form-control', 'autocomplete' => 'off', 'aria-label' => 'Amount (to the nearest pound)')) }}
                      </div>
                      @if( $errors->has('rate'))
                        <div class="help-block">
                          <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $errors->first('rate') }}</strong>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                  @if( $errors->has('reservation') or $errors->has('hire'))
                    <div class="form-group has-error">
                      <div class="form-row">
                        <div class="alert alert-danger" role="alert">
                          <div class="help-block">
                            <div class="row">
                              @if($errors->has('reservation'))
                                <div class="col-md-6">
                                  <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                                  <strong>Start date = {{ $errors->get('reservation')['start_date'] }}</strong><br>
                                  <strong>End date = {{ $errors->get('reservation')['end_date'] }}</strong>
                                </div>
                              @endif
                              @if($errors->has('hire'))
                                <div class="col-md-6">
                                  <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Current active hire</strong><br>
                                  <strong>Start date = {{ $errors->get('hire')['start_date'] }}</strong><br>
                                  <strong>End date = {{ $errors->get('hire')['end_date'] }}</strong>
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