@extends('layouts.public')

@section('content')
@foreach($vehicles as $vehicle)
  @include('admin.vehicle.modals.image-gallery')
@endforeach
<div class="jumbotron jumbotron-header">
  <div class="container">
    <h1>Our fleet</h1>
    <p style="text-align: justify">Below are all the vehicles in that are in our fleet</p>
  </div>
</div>
<div class="jumbotron jumbotron-content">
  <div class="container">
    <div class="row">
      @include('admin.vehicle.lists.public')
    </div>
  </div>
</div>
@endsection
