@extends('layouts.admin-main')

@section('content')
<div class="row">
<div class="col-md-4 col-sm-8 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading"><h3>Add a vehicle rate</h3></div>
    <div class="panel-body">
      <form action="{{ route('vehicle-rate.add') }}" method="post">
        @csrf
        <div class="form-row">
          <div class="form-group{{ $errors->has('engine_size') ? ' has-error' : '' }} col-md-12">
            <label for="make">Engine Size</label>
            <input type="text" class="form-control" id="engine_size" name="engine_size" value="{{ old('engine_size') }}" autocomplete="off" placeholder="Enter engine size">
            @if( $errors->has('engine_size'))
              <span class="help-block">
                  <strong>{{ $errors->first('engine_size') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-row">
          <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }} col-md-12">
            <label for="model">Weekly Rate Minimum</label>
            <input type="text" class="form-control" id="weekly_rate_min" name="weekly_rate_min" value="{{ old('weekly_rate_min') }}" autocomplete="off" placeholder="Enter min rate">
            @if( $errors->has('weekly_rate_min'))
              <span class="help-block">
                  <strong>{{ $errors->first('weekly_rate_min') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-row">
          <div class="form-group{{ $errors->has('weekly_rate_max') ? ' has-error' : '' }} col-md-12">
            <label for="model">Weekly Rate Maximum</label>
            <input type="text" class="form-control" id="weekly_rate_max" name="weekly_rate_max" value="{{ old('weekly_rate_max') }}" autocomplete="off" placeholder="Enter max rate">
            @if( $errors->has('weekly_rate_max'))
              <span class="help-block">
                  <strong>{{ $errors->first('weekly_rate_max') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-row">
          <div class="col-xs-2">
            <button type="submit" class="btn btn-primary">Add Vehicle Rate</button>
          </div>
          <div class="col-xs-1">
            <a href="{{ route('vehicle-rate.index') }}" class="btn btn-primary" role="button" aria-pressed="true">Back</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
