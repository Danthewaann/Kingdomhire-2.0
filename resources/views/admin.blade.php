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
            <div class="col-md-7">
                @include('admin.vehicle.add')
            </div>
        @endif
        <div class="col-md-5">
            @include('admin.reservation.list')
        </div>
        <div class="col-md-5">
            @include('admin.hire.list')
        </div>
    </div>
</div>
@endsection
