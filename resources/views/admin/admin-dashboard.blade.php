@extends('layouts.admin-main')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if(!$vehicles->isEmpty())
        <div class="col-md-12">
            @include('admin.vehicle.list')
        </div>
    @endif

    @if(!$vehicles->isEmpty() and !$rates->isEmpty())
        <div class="col-md-6">
            @include('admin.vehicle-rate.list')
            @include('admin.vehicle.add')
            @include('admin.vehicle-rate.add')
        </div>
    @endif

    <div class="col-md-6">
        @include('admin.reservation.list')
    </div>
    <div class="col-md-6">
        @include('admin.hire.list')
    </div>
</div>
@endsection
