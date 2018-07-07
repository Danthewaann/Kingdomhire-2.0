@extends('layouts.admin-main')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-body">
          @foreach($vehicles as $vehicle)
            @include('admin.vehicle.list-admin')
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection