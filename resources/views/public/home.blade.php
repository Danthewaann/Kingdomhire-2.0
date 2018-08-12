@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
	{{--<div class="bg"></div>--}}
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>What is Kingdomhire?</h1>
			</div>
			<div class="col-md-8">
				<h2>Car &amp; Van Hire Specialist</h2>
				<p>Kingdomhire is a one-man business owned and ran by proprietor Keith Black. The business specialises in vehicle hire and repair.
					 Keith's experience spans over 40 years of working in the motor industry, so you can expect high quality service.</p>
				<p>Kingdomhire is located and based just outside Markethill, Co. Armagh. Exact directions can be found on our <a class="text-link" href="{{ route('public.contact') }}">Contact page.</a></p>
				<p>Kingdom Car Hire cater for general, public and business needs. Whatever you need, we are sure we can help you out.</p>
			</div>
			<div class="col-md-4">
				<h2><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Opening hours</h2>
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
				{{--<h2>Making a reservation</h2>--}}
				{{--<p>You need to call us to be able to reserve a vehicle. Make sure to reserve your vehicle at least 1 day before expected pickup.</p>--}}
			</div>
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
					<div class="col-md-12"><h2>Our fleet of vehicles</h2></div>
					<div class="col-md-6">
						{{--<img src="{{ asset('static/insideCar.jpg') }}" alt="" width="100%">--}}
						{{--<h2>Our fleet of vehicles</h2>--}}
						<p>We have a wide selection of vehicles to choose from. We provide hatchbacks, 4-door salons, people carriers, small vans and large vans.</p>
						<p>Our fleet is ever expanding to include more diverse vehicles, and we ensure that our vehicles are reliable and maintained, so make sure to get in
							touch to see if we have what you want.</p>
					</div>
					<div class="col-md-6">
						<img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%">
					</div>
					{{--<div class="col-md-12">--}}
						{{--<img src="{{ asset('static/carRepair.jpg') }}" alt="" width="100%">--}}
						{{--<img src="{{ asset('static/home.jpg') }}" alt="" width="100%">--}}
					{{--</div>--}}
				</div>
			</div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12"><h2>Making a reservation</h2></div>
					<div class="col-md-6">
						<p>You need to call us to be able to reserve a vehicle. Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
					</div>
					<div class="col-md-6">
						<img src="{{ asset('static/home.jpg') }}" alt="" width="100%">
					</div>
				</div>
			</div>
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