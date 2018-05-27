@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h3>Edit Hire Form</h3></div>
    <div class="panel-body">
      <form action="{{ route('hire.edit', ['make' => $make, 'model' => $model, 'vehicle_id' => $vehicle_id, 'hire_id' => $hire->id]) }}" method="post">
        {{csrf_field()}}
        <div class="form-row">
          <div class="form-group col-md-12">
            <div class="form-row">
              <label for="vehicle">Vehicle</label>
              <input id="vehicle" style="max-width: 300px;" class="form-control" type="text" value="{{ $make.' '.$model }}" disabled/>
            </div>
          </div>
          <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }} col-md-12">
            <div class="form-row">
              <label for="start_date">Start Date</label>
              <input id="start_date" name="start_date" style="max-width: 300px;" class="form-control" type="text" value="{{ $hire->start_date }}" readonly/>
              @if( $errors->has('start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
              @endif
            </div>
          </div>
          <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }} col-md-12">
            <div class="form-row">
              <label for="end_date">End Date</label>
              {{ Form::text('end_date', $hire->end_date, array('class' => 'form-control datepicker', 'style' => 'max-width: 300px;')) }}
              @if( $errors->has('end_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
              @endif
            </div>
          </div>
          @if( $errors->has('conflict'))
            <div class="form-group has-error col-md-12">
              <div class="form-row">
                  <span class="help-block">
                    @foreach($errors->get('conflict') as $error)
                      <strong>{{ $error }}</strong><br>
                    @endforeach
                  </span>
              </div>
            </div>
          @endif
          <div class="form-row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary">Edit Hire</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection