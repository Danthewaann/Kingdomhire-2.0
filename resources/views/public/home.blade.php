@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
	<div class="container">
		<div class="row">
			{{--<div class="col-md-12">--}}
				{{--<h1 style="margin-bottom: 0px; margin-top: 10px">Kingdomhire</h1>--}}
				{{--<h3 style="margin-top: 10px">Car &amp; Van Hire Specialist</h3>--}}
			{{--</div>--}}
			<div class="col-md-8">
				<h1 style="margin-bottom: 0px; margin-top: 10px">Kingdomhire</h1>
				<h3 style="margin-top: 10px">Car &amp; Van Hire Specialist</h3>
				<p class="lead" style="text-align: justify;">Kingdomhire is a one-man business owned and ran by proprietor Keith Black. The business specialises in vehicle hire and repair.
					 Keith's experience spans over 40 years of working in the motor industry, so you can expect high quality service.</p>
				<p class="lead" style="text-align: justify;">Kingdomhire is located and based just outside <b>Markethill, Co. Armagh.</b> Exact directions can be found on our <b><a class="text-link" href="{{ route('public.contact') }}">Contact page.</a></b>
					Kingdom Car Hire cater for general, public and business needs. Whatever you need, we are sure we can help you out.</p>
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
				<div class="row">
					<div class="col-md-6">
            <img src="{{ asset('static/van-right.jpg') }}" alt="" width="100%" style="box-shadow: rgba(0,0,0, 0.1) 0 0 10px; ">
						<h2 style="text-align: justify; ">Our fleet of vehicles</h2>
						<p style="text-align: justify">We have a wide selection of vehicles to choose from. We provide hatchbacks, 4-door saloons, people carriers, small vans and large vans.
						Our fleet is ever expanding to include more diverse vehicles, and we ensure that our vehicles are reliable and maintained, so make sure to get in
							touch to see if we have what you want.</p>
					</div>
          <div class="col-md-6">
            <img src="{{ asset('static/home.jpg') }}" alt="" width="100%" style="box-shadow: rgba(0,0,0, 0.1) 0 0 10px; ">
            <h2 style="text-align: justify:">Making a reservation</h2>
            <p style="text-align: justify">You need to call us to be able to reserve a vehicle. Make sure to reserve your vehicle at least 1 day before expected pickup.</p>
          </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection