@extends('layouts.admin-main')

@section('content')
<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
  <div class="row">
    @include('admin.common.alert')
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>Edit reservation</h2>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" action="{{ route('admin.reservations.update', ['reservation' => $reservation->name]) }}" method="post">
          @csrf
          @method('PATCH')
            <div class="form-group">
              <label for="name" class="control-label col-sm-4">Belongs to</label>
              <div class="col-sm-6">
                {{ Form::text('vehicle', $vehicle->name().' - '.$vehicle->name, array('class' => 'form-control', 'disabled' => 'true')) }}
              </div>
            </div>
            <div class="form-group{{ $errors->reservations->has('start_date') ? ' has-error' : '' }}">
              <label for="start_date" class="control-label col-sm-4">Start Date*</label>
              <div class="col-sm-6">
                <div class="input-group">
                  {{ Form::text('start_date', $reservation->start_date, array(
                    'class' => 'form-control', 'autocomplete' => 'off', 'readonly' => 'readonly', 'placeholder' => 'e.g. '.date('Y-m-d'), 'id' => 'start_date'))
                  }}
                  <span class="input-group-addon" id="start_date_calender"> <span class="glyphicon glyphicon-calendar"></span></span>
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
              <label for="end_date" class="control-label col-sm-4">End Date*</label>
              <div class="col-sm-6">
                <div class="input-group">
                  {{ Form::text('end_date', $reservation->end_date, array(
                    'class' => 'form-control datepicker', 'autocomplete' => 'off', 'readonly' => 'readonly',
                    'placeholder' => 'e.g. '.date('Y-m-d', strtotime(date('Y-m-d') . ' +3 days')), 'id' => 'end_date'))
                  }}
                  <span class="input-group-addon" id="end_date_calender"> <span class="glyphicon glyphicon-calendar"></span></span>
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
                <div class="col-sm-6 col-sm-offset-4">
                  <div class="alert alert-danger" role="alert">
                    <div class="help-block">
                      <div class="row">
                        @if($errors->reservations->has('reservation'))
                          <div class="col-sm-12">
                            <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Other reservation</strong><br>
                            <strong>Start date = {{ $errors->reservations->get('reservation')['start_date'] }}</strong><br>
                            <strong>End date = {{ $errors->reservations->get('reservation')['end_date'] }}</strong>
                          </div>
                        @endif
                        @if($errors->reservations->has('reservation') and $errors->reservations->has('hire'))
                          <hr>
                        @endif
                        @if($errors->reservations->has('hire'))
                          <div class="col-sm-12">
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
              <div class="col-sm-6 col-sm-offset-4">
                <div class="btn-group">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;&nbsp;Update</button>
                  <a href="{{ Session::get('url') }}" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span>&nbsp;&nbsp;Back</a>
                </div>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection