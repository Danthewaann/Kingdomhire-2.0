@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        @if(!$vehicles->isEmpty())
            <div class="col-md-3">
               @include('admin.vehicle.list')
            </div>
            <div class="col-md-4">
                @include('admin.vehicle.delete')
            </div>
        @endif
        <div class="col-md-5">
            @include('admin.vehicle.add')
        </div>
    </div>
    <div class="row">
        @if(!$reservations->isEmpty())
            <div class="col-md-5">
               @include('admin.reservation.list')
            </div>
            <div class="col-md-3">
                @include('admin.reservation.delete')
            </div>
        @endif
        <div class="col-md-4">
            @include('admin.reservation.add')
        </div>
    </div>
    <div class="row">
        @if(!$hires->isEmpty())
            <div class="col-md-5">
                @include('admin.hire.list')
            </div>
            <div class="col-md-3">
                @include('admin.hire.delete')
            </div>
        @endif
        <div class="col-md-4">
            @include('admin.hire.add')
        </div>
    </div>
</div>
@endsection
