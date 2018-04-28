@extends('layouts.admin-main')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="col-md-6">
        @include('admin.vehicle.list')
    </div>
    <div class="col-md-6">
        @include('admin.reservation.list')
        @include('admin.hire.list')
    </div>
        <div class="col-md-6">
        @include('admin.vehicle.add')
        </div>

    @if(!$rates->isEmpty())
        <div class="col-md-6">
            @include('admin.vehicle-rate.list')
            @include('admin.vehicle-rate.add')
        </div>
    @endif
</div>
@endsection
