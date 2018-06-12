@extends('layouts.admin-main')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><h3>Edit Vehicle Rate</h3></div>
    <div class="panel-body">
      <form action="{{ route('vehicle-rate.edit', ['rate' => $rate->engine_size]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="engine_size">Engine Size</label>
            <input id="engine_size" name="engine_size" style="max-width: 300px;" class="form-control" value="{{ $rate->engine_size }}" readonly/>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }} col-md-12">
            <label for="rate_min">Weekly Rate Min</label>
            <input type="text" style="max-width: 300px;" class="form-control" name="weekly_rate_min" value="{{ $rate->weekly_rate_min }}">
            @if( $errors->has('weekly_rate_min'))
              <span class="help-block">
                <strong>{{ $errors->first('weekly_rate_min') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-row">
          <div class="form-group{{ $errors->has('weekly_rate_max') ? ' has-error' : '' }} col-md-12">
            <label for="rate_max">Weekly Rate Max</label>
            <input type="text" style="max-width: 300px;" class="form-control" name="weekly_rate_max" value="{{ $rate->weekly_rate_max }}">
            @if( $errors->has('weekly_rate_max'))
              <span class="help-block">
                <strong>{{ $errors->first('weekly_rate_max') }}</strong>
              </span>
            @endif
          </div>
        </div>
        <div class="form-row">
          <div class="col-xs-1">
            <button type="submit" class="btn btn-primary">Edit Rate</button>
          </div>
          <div class="col-xs-1">
            <a href="{{ route('vehicle-rate.index') }}" class="btn btn-primary" role="button" aria-pressed="true">Back</a>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
