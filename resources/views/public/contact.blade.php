@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
  <div class="container">
    <h1>Contact us</h1>
    <p>Have any queries or complaints? You can contact us via mobile phone or email, whichever you prefer.</p>
    <h3>Our contact information</h3>
    <div class="col-md-6">
      <div class="row">
        <table class="table contact-info">
          <tr>
            <th>Phone</th>
            <th>Email</th>
          </tr>
          <tr>
            <td style="max-width: 200px">0777 55 34402</td>
            <td style="max-width: 200px"><span style="word-wrap: break-word;">kingdomhire@googlemail.com</span></td>
          </tr>
          <tr>
            <td>
              <a href="tel:07775534402" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-earphone"></span>&nbsp; Phone Us</a>
            </td>
            <td>
              <a href="mailto:kingdomhire@googlemail.com" class="btn btn-info btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Email Us</a>
            </td>
          </tr>
        </table>
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