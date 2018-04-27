@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Vehicle list</h3>
        @foreach($vehicles as $vehicle)
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-body">
                @include('admin.vehicle.list-public')
              </div>
            </div>
          </div>
        @endforeach
    </div>
  </div>
@endsection
