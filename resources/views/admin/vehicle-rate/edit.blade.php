@extends('layouts.admin-main')

@section('content')
<div class="row">
  <div class="col-md-4 col-sm-8 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading panel-title-text"><h3>Edit vehicle price rate</h3></div>
    <div class="panel-body">
      <form action="{{ route('vehicle-rate.edit', ['rate' => $rate->engine_size]) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="engine_size">Engine Size</label>
            <input id="engine_size" name="engine_size" class="form-control" value="{{ $rate->engine_size }}" autocomplete="off" readonly/>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group{{ $errors->has('weekly_rate_min') ? ' has-error' : '' }} col-md-12">
            <label for="rate_min">Weekly Rate Min</label>
            <input id="rate_min" type="text" class="form-control" name="weekly_rate_min" value="{{ $rate->weekly_rate_min }}" autocomplete="off">
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
            <input id="rate_max" type="text" class="form-control" name="weekly_rate_max" value="{{ $rate->weekly_rate_max }}" autocomplete="off">
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
        </div>
      </form>
    </div>
  </div>
  </div>
</div>
@endsection
