@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 style="text-align: justify">Contact us</h1>
      </div>
      <div class="col-md-4" style="margin-bottom: 22px">
        <p style="text-align: justify">Have any queries or complaints? You can contact us via mobile phone or email, whichever you prefer.</p>
        <h2 style="text-align: justify"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Contact Information</h2>
        <table class="table contact-info">
          <tr>
            <th>Phone</th>
            <td>0777 55 34402</td>
          </tr>
          <tr>
            <th>E-Mail</th>
            <td><span style="word-wrap: break-word;">kingdomhire@googlemail.com</span></td>
          </tr>
        </table>
        <div class="btn-group btn-group-justified">
          <div class="btn-group">
            <a href="tel:07775534402" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-earphone"></span>&nbsp; Phone Us</a>
          </div>
          <div class="btn-group">
            <a href="mailto:kingdomhire@googlemail.com" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Email Us</a>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <h2 style="margin-top: 0">Directions</h2>
        <p>You can use the map below to help find your way to Kingdom Hire.</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9313.696456269257!2d-6.502924066660125!3d54.29645086742982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9d3b28ee1d8f52c1!2sKingdom+Car+Hire!5e0!3m2!1sen!2suk!4v1459283163122"
                class="map" frameborder="0">
        </iframe>
      </div>
      {{--<div class="col-md-4">--}}
        {{--<div class="row">--}}
          {{--<div><h1 style="text-align: justify">Contact us</h1></div>--}}
        {{--</div>--}}
      {{--</div>--}}
      {{--<div class="col-md-12">--}}
        {{--<div class="row">--}}
          {{--<div class="col-md-4"><p style="text-align: justify">Have any queries or complaints? You can contact us via mobile phone or email, whichever you prefer.</p></div>--}}
          {{--<div class="col-md-6 col-md-offset-3">--}}
            {{--<p style="text-align: center">Have any queries or complaints? You can contact us via mobile phone or email, whichever you prefer.</p>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
      {{--<div class="col-md-12">--}}
        {{--<div class="row">--}}
          {{--<div class="col-md-4">--}}
            {{--<h2 style="text-align: justify"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Contact Information</h2>--}}
            {{--<table class="table contact-info">--}}
              {{--<tr>--}}
                {{--<th>Phone</th>--}}
                {{--<td>0777 55 34402</td>--}}
              {{--</tr>--}}
              {{--<tr>--}}
                {{--<th>E-Mail</th>--}}
                {{--<td><span style="word-wrap: break-word;">kingdomhire@googlemail.com</span></td>--}}
              {{--</tr>--}}
            {{--</table>--}}
            {{--<div class="btn-group btn-group-justified">--}}
              {{--<div class="btn-group">--}}
                {{--<a href="tel:07775534402" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-earphone"></span>&nbsp; Phone Us</a>--}}
              {{--</div>--}}
              {{--<div class="btn-group">--}}
                {{--<a href="mailto:kingdomhire@googlemail.com" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Email Us</a>--}}
              {{--</div>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
    {{--<h3>Our contact information</h3>--}}

    {{--<div class="col-md-4">--}}
      {{--<div class="row">--}}
        {{--<table class="table contact-info">--}}
          {{--<tr>--}}
            {{--<th>Phone</th>--}}
            {{--<th>Email</th>--}}
          {{--</tr>--}}
          {{--<tr>--}}
            {{--<td style="max-width: 200px">0777 55 34402</td>--}}
            {{--<td style="max-width: 150px"><span style="word-wrap: break-word;">kingdomhire@googlemail.com</span></td>--}}
          {{--</tr>--}}
          {{--<tr>--}}
            {{--<td>--}}
              {{--<a href="tel:07775534402" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-earphone"></span>&nbsp; Phone Us</a>--}}
            {{--</td>--}}
            {{--<td>--}}
              {{--<a href="mailto:kingdomhire@googlemail.com" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Email Us</a>--}}
            {{--</td>--}}
          {{--</tr>--}}
        {{--</table>--}}
        {{--<h2 style="text-align: center"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Contact Information</h2>--}}
        {{--<table class="table contact-info">--}}
          {{--<tr>--}}
            {{--<th>Phone</th>--}}
            {{--<td>0777 55 34402</td>--}}
          {{--</tr>--}}
          {{--<tr>--}}
            {{--<th>E-Mail</th>--}}
            {{--<td><span style="word-wrap: break-word;">kingdomhire@googlemail.com</span></td>--}}
          {{--</tr>--}}
        {{--</table>--}}
        {{--<div class="btn-group btn-group-justified">--}}
          {{--<div class="btn-group">--}}
            {{--<a href="tel:07775534402" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-earphone"></span>&nbsp; Phone Us</a>--}}
          {{--</div>--}}
          {{--<div class="btn-group">--}}
            {{--<a href="mailto:kingdomhire@googlemail.com" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Email Us</a>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
    </div>
  </div>
</div>
{{--<div class="jumbotron jumbotron-content">--}}
  {{--<div class="container">--}}
    {{--<h1>Directions</h1>--}}
    {{--<p>You can use the map below to help find your way to Kingdom Hire.</p>--}}
    {{--<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9313.696456269257!2d-6.502924066660125!3d54.29645086742982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9d3b28ee1d8f52c1!2sKingdom+Car+Hire!5e0!3m2!1sen!2suk!4v1459283163122"--}}
            {{--class="map" frameborder="0">--}}
    {{--</iframe>--}}
  {{--</div>--}}
{{--</div>--}}
@endsection