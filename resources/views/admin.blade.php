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
            <div class="col-md-12">
               @include('admin.vehicle.list')
            </div>
        @endif
    </div>
    <div class="row">
        @if(!$vehicles->isEmpty())
            <div class="col-md-6">
                @include('admin.vehicle.add')
            </div>
        @endif
        @if(!$reservations->isEmpty())
            <div class="col-md-6">
                @include('admin.reservation.list')
            </div>
        @endif
        @if(!$hires->isEmpty())
            <div class="col-md-6">
                @include('admin.hire.list')
            </div>
        @endif
    </div>
</div>
@endsection
