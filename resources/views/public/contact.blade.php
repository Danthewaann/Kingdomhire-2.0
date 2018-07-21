@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
  <div class="container">
    <h1>Contact us</h1>
    <p>Have any queries or complaints? You can contact us via mobile phone or email, whichever you prefer.</p>
    <h3>Our contact information</h3>
    <div class="col-md-12">
      <div class="row">
        <table class="table opening-hours" style="width: 50%">
          <tr>
            <th>Mobile number</th>
            <td><span style="margin-right: 10px">0777 55 34402</span>
              <a href="tel:07775534402" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Phone Us</a>
            </td>
          </tr>
          <tr>
            <th>Email</th>
            <td>kingdomhire@googlemail.com</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <form action="{{ route('reservation.log', ['id' => '1']) }}" method="post">
          @csrf
          <div class="form-row">
            <div class="form-group">
              <div class="form-row">
                <label for="title">Title</label>
                <input id="title" name="title" class="form-control" type="text"/>
              </div>
            </div>
            <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
              <div class="form-row">
                <label for="start_date">Start Date</label>
                {{ Form::text('start_date', '', array('class' => 'form-control datepicker', 'autocomplete' => 'off')) }}
                @if( $errors->has('start_date'))
                  <span class="help-block">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>{{ $errors->first('start_date') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
              <div class="form-row">
                <label for="end_date">End Date</label>
                {{ Form::text('end_date', '', array('class' => 'form-control datepicker', 'autocomplete' => 'off')) }}
                @if( $errors->has('end_date'))
                  <span class="help-block">
                      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <strong>{{ $errors->first('end_date') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            @if( $errors->has('reservation') or $errors->has('hire'))
              <div class="form-group has-error">
                <div class="form-row">
                    <span class="help-block">
                      @if($errors->has('reservation'))
                        <strong>Other reservation</strong><br>
                        <strong>Start date = {{ $errors->get('reservation')['start_date'] }}</strong><br>
                        <strong>End date = {{ $errors->get('reservation')['end_date'] }}</strong>
                        <br><br>
                      @endif
                      @if($errors->has('hire'))
                        <strong>Current active hire</strong><br>
                        <strong>Start date = {{ $errors->get('hire')['start_date'] }}</strong><br>
                        <strong>End date = {{ $errors->get('hire')['end_date'] }}</strong>
                      @endif
                    </span>
                </div>
              </div>
            @endif
            <div class="form-row">
              <button type="submit" class="btn btn-primary">Email</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="jumbotron jumbotron-content">
  <div class="container">
    <h1>Directions</h1>
    <p>You can use the map below to help find your way to Kingdom Hire.</p>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9313.696456269257!2d-6.502924066660125!3d54.29645086742982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9d3b28ee1d8f52c1!2sKingdom+Car+Hire!5e0!3m2!1sen!2suk!4v1459283163122"
            class="map" frameborder="0">
    </iframe>
  </div>
</div>
@endsection