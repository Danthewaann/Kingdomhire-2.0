@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="main-header">Contact us</h1>
        <p class="paragraph">Have any queries? <br>You can contact us via mobile phone or email, whichever you prefer.</p>
      </div>
      <div class="col-md-4 col-sm-12">
        <div class="row">
          <div class="col-md-12 col-sm-6">
            @include('public.opening-hours-table')
          </div>
          <div class="col-md-12 col-sm-6">
            @include('public.contact-table')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Where to find us?</h2>
        <p>For directions, you can use the map below to help find your way to Kingdom Hire.</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9313.696456269257!2d-6.502924066660125!3d54.29645086742982!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9d3b28ee1d8f52c1!2sKingdom+Car+Hire!5e0!3m2!1sen!2suk!4v1459283163122"
                class="map" frameborder="0">
        </iframe>
      </div>
    </div>
  </div>
</div>
@endsection