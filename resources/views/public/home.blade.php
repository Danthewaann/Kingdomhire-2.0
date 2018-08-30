@extends('layouts.public')

@section('content')
<div class="jumbotron jumbotron-header">
	<div class="container">
		{{--<div class="row">--}}
			{{--<div class="col-md-12">--}}
				<div class="row">
					<div class="col-md-12">
						<h1>What is Kingdomhire?</h1>
					</div>
					<div class="col-md-8">
						<h2>Car &amp; Van Hire Specialist</h2>
						<p style="text-align: justify;">Kingdomhire is a one-man business owned and ran by proprietor Keith Black. The business specialises in vehicle hire and repair.
							 Keith's experience spans over 40 years of working in the motor industry, so you can expect high quality service.</p>
						<p style="text-align: justify;">Kingdomhire is located and based just outside <b>Markethill, Co. Armagh.</b> Exact directions can be found on our <b><a class="text-link" href="{{ route('public.contact') }}">Contact page.</a></b></p>
						<p style="text-align: justify;">Kingdom Car Hire cater for general, public and business needs. Whatever you need, we are sure we can help you out.</p>
					</div>
					<div class="col-md-4 col-sm-12">
						<div class="row">
							<div class="col-md-12 col-sm-6">
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
							</div>
							<div class="col-md-12 col-sm-6">
								<h2 style="margin-top: 10px;"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Contact Information</h2>
								<table class="table contact-info">
									<tr>
										<th>Phone</th>
										<td>07775534402</td>
									</tr>
									<tr>
										<th>E-Mail</th>
										<td><span style="word-wrap: break-word;">kingdomhire@googlemail.com</span></td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="btn-group btn-group-justified">
												<div class="btn-group">
													<a href="tel:07775534402" class="btn btn-primary btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-earphone"></span>&nbsp; Phone Us</a>
												</div>
												<div class="btn-group">
													<a href="mailto:kingdomhire@googlemail.com" class="btn btn-primary btn-lg" role="button" aria-pressed="true"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Email Us</a>
												</div>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			{{--</div>--}}
		{{--</div>--}}
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
						<p style="text-align: justify">We have a wide selection of vehicles to choose from. We provide hatchbacks, 4-door salons, people carriers, small vans and large vans.</p>
						<p style="text-align: justify">Our fleet is ever expanding to include more diverse vehicles, and we ensure that our vehicles are reliable and maintained, so make sure to get in
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