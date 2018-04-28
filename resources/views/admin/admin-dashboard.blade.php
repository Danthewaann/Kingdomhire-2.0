@extends('layouts.admin-main')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading"><h1>Main Dashboard</h1></div>
        {{--<div class="panel-body">--}}
        {{--</div>--}}
    </div>
            <div class="col-md-6">
                @include('admin.vehicle.list')
            </div>
            <div class="col-md-6">
                @include('admin.reservation.list')
                @include('admin.hire.list')
            </div>
        {{--</div>--}}
    {{--</div>--}}
@endsection
