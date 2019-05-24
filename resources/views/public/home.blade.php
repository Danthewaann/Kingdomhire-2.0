@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="main-header">Kingdomhire</h1>
				<h3>Car &amp; Van Hire Specialist</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<p class="paragraph">Kingdomhire is a one-man business owned and ran by proprietor Keith Black. The business specialises in vehicle hire and repair.
					 Keith's experience spans over 40 years of working in the motor industry, so you can expect high quality service.</p>
				<p class="paragraph">Kingdomhire is located and based just outside <b>Markethill, Co. Armagh.</b> Exact directions can be found on our <b><a class="text-link" href="{{ route('public.contact') }}">Contact page.</a></b>
					Kingdom Car Hire cater for general, public and business needs. Whatever you need, we are sure we can help you out.</p>
			</div>
		</div>
	</div>
</div>
<div class="jumbotron jumbotron-content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<img src="{{ asset('static/van-right.jpg') }}" width="100%">
						<h2>Our Fleet of Vehicles</h2>
						<p class="paragraph">We have a wide selection of vehicles to choose from. We provide hatchbacks, 4-door saloons, people carriers, small vans and large vans.
						Our fleet is ever expanding to include more diverse vehicles, and we ensure that our vehicles are reliable and maintained, so make sure to get in
							touch to see if we have what you want.</p>
					</div>
					<div class="col-md-6">
						<img src="{{ asset('static/home.jpg') }}" width="100%">
						<h2>Making a Reservation</h2>
						<p class="paragraph">You need to call us to be able to reserve a vehicle. Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection