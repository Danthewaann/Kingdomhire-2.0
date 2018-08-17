@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
	{{--<div class="bg"></div>--}}
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-8"><h1 style="text-align: justify;">What is Kingdomhire?</h1></div>
						</div>
					</div>
					<div class="col-md-8">
						{{--<h1 style="text-align: center;">What is Kingdomhire?</h1>--}}
            {{--<h1>What is Kingdomhire?</h1>--}}
						<h2 style="text-align: justify; margin-top: 10px;">Car &amp; Van Hire Specialist</h2>
						<p style="text-align: justify;">Kingdomhire is a one-man business owned and ran by proprietor Keith Black. The business specialises in vehicle hire and repair.
							 Keith's experience spans over 40 years of working in the motor industry, so you can expect high quality service.</p>
						<p style="text-align: justify;">Kingdomhire is located and based just outside <b>Markethill, Co. Armagh.</b> Exact directions can be found on our <b><a class="text-link" href="{{ route('public.contact') }}">Contact page.</a></b></p>
						<p style="text-align: justify;">Kingdom Car Hire cater for general, public and business needs. Whatever you need, we are sure we can help you out.</p>
            {{--<div>--}}
              {{--<div><img src="{{ asset('static/home.jpg') }}" alt="" width="100%"></div>--}}
              {{--<div><img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%"></div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
              {{--<div class="col-md-6" style="margin-top: 10px;">--}}
                {{--<img src="{{ asset('static/van-right.jpg') }}" alt="" width="100%">--}}
              {{--</div>--}}
              {{--<div class="col-md-6" style="margin-top: 10px;">--}}
                {{--<div><img src="{{ asset('static/home.jpg') }}" alt="" width="100%"></div>--}}
              {{--</div>--}}
              {{--<div class="col-md-6" style="margin-top: 30px;">--}}
                {{--<div><img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%"></div>--}}
              {{--</div>--}}
            {{--</div>--}}
					</div>
					<div class="col-md-4">
						<h2 style="text-align: justify; margin-top: 10px;"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Opening hours</h2>
						<table class="table opening-hours">
							<tr>
								<th>Weekdays</th>
								<td>9am - 6pm</td>
							</tr>
							<tr>
								<th>Saturday</th>
								<td>9am - 1pm</td>
							</tr>
							<tr>
								<th>Sunday</th>
								<td>Closed</td>
							</tr>
						</table>
						<h2 style="text-align: justify"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Contact Information</h2>
						<table class="table contact-info">
							<tr>
								<th>Phone</th>
								<td>07775534402</td>
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
				</div>
			</div>
      {{--<div class="col-md-12">--}}
        {{--<div class="row">--}}
          {{--<div class="col-md-4" style="margin-top: 30px;">--}}
            {{--<img src="{{ asset('static/van-right.jpg') }}" alt="" width="100%">--}}
          {{--</div>--}}
          {{--<div class="col-md-4" style="margin-top: 30px;">--}}
            {{--<div><img src="{{ asset('static/home.jpg') }}" alt="" width="100%"></div>--}}
          {{--</div>--}}
          {{--<div class="col-md-4" style="margin-top: 30px;">--}}
            {{--<div><img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%"></div>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}
		</div>
	</div>
</div>
<div class="jumbotron jumbotron-content">
	<div class="container">
		<div class="row">
			{{--<div class="col-md-4">--}}
				{{--<img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%">--}}
					{{--<h2>What we provide</h2>--}}
					{{--<p>Kingdom Car Hire cater for general, public and business needs. Whatever you need, we are sure we can help you out.</p>--}}
			{{--</div>--}}
			<div class="col-md-12">
				<div class="row">
					{{--<div class="col-md-12"><h2 style="text-align: center">Our fleet of vehicles</h2></div>--}}
					<div class="col-md-6">
            <img src="{{ asset('static/van-right.jpg') }}" alt="" width="100%">
						<h2 style="text-align: justify; ">Our fleet of vehicles</h2>
						{{--<img src="{{ asset('static/insideCar.jpg') }}" alt="" width="100%">--}}
						{{--<h2>Our fleet of vehicles</h2>--}}
						<p style="text-align: justify">We have a wide selection of vehicles to choose from. We provide hatchbacks, 4-door salons, people carriers, small vans and large vans.</p>
						<p style="text-align: justify">Our fleet is ever expanding to include more diverse vehicles, and we ensure that our vehicles are reliable and maintained, so make sure to get in
							touch to see if we have what you want.</p>
					</div>
          <div class="col-md-6">
            <img src="{{ asset('static/home.jpg') }}" alt="" width="100%">
            <h2 style="text-align: justify:">Making a reservation</h2>
            <p style="text-align: justify">You need to call us to be able to reserve a vehicle. Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
          </div>
					{{--<div class="col-md-6">--}}
						{{--<img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%">--}}
					{{--</div>--}}
					{{--<div class="col-md-12">--}}
						{{--<img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%">--}}
						{{--<img src="{{ asset('static/home.jpg') }}" alt="" width="100%">--}}
					{{--</div>--}}
				</div>
			</div>
			{{--<div class="col-md-12">--}}
				{{--<div class="row">--}}
					{{--<div class="col-md-12"><h2 style="text-align: center">Making a reservation</h2></div>--}}
					{{--<div class="col-md-6">--}}
						{{--<h2 style="text-align: justify; margin-top: 10px;">Making a reservation</h2>--}}
						{{--<p style="text-align: justify">You need to call us to be able to reserve a vehicle. Make sure to reserve your vehicle at least 1 day before expected pickup.</p>--}}
					{{--</div>--}}
					{{--<div class="col-md-6">--}}
						{{--<img src="{{ asset('static/home.jpg') }}" alt="" width="100%">--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<div class="col-md-4">--}}
				{{--<img src="{{ asset('static/insideCar.jpg') }}" alt="" width="100%">--}}
				{{--<h2>Out fleet of vehicles</h2>--}}
				{{--<p>Our fleet is ever expanding to include more diverse vehicles, and we ensure that our vehicles are reliable and maintained, so make sure to get in--}}
					{{--touch to see if we have what you want.</p>--}}
			{{--</div>--}}
			{{--<div class="col-md-4">--}}
				{{--<h2>Opening hours</h2>--}}
				{{--<table class="table opening-hours">--}}
					{{--<tr>--}}
						{{--<th>Weekdays</th>--}}
						{{--<td>9am - 6pm</td>--}}
					{{--</tr>--}}
					{{--<tr>--}}
						{{--<th>Saturday</th>--}}
						{{--<td>9am - 1pm</td>--}}
					{{--</tr>--}}
					{{--<tr>--}}
						{{--<th>Sunday</th>--}}
						{{--<td>Closed</td>--}}
					{{--</tr>--}}
				{{--</table>--}}
				{{--<h2>Making a reservation</h2>--}}
				{{--<p>You need to call us to be able to reserve a vehicle.</p>--}}
				{{--<p>Make sure to reserve your vehicle at least 1 day before expected pickup</p>--}}
			{{--</div>--}}
		</div>
	</div>
</div>
@endsection