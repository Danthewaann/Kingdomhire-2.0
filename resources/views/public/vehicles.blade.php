@extends('layouts.public')

@section('content')
<section class="jumbotron jumbotron-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <header><h1 class="main-header">Our Fleet</h1></header>
      </div>
      <div class="col-md-6">
        <p class="paragraph">
          Below are most of the vehicles that are in our fleet. Not all our vehicles may be be listed on this page,
          so it's best to <b><a class="text-link" href="{{ route('public.contact') }}">Contact Us</a></b> to see what we have available.
        </p>
      </div>
    </div>
  </div>
</section>
<section class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      @include('admin.vehicle.lists.public')
    </div>
  </div>
</section>
@endsection
