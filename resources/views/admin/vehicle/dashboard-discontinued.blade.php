@extends('layouts.admin-main')

@section('content')
  @include('admin.vehicle.modal-gallery')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-5 col-sm-5">
        <div class="well">
          <h2 style="text-align: center">Vehicle Dashboard</h2>
          <h4 style="text-align: center">{{ $vehicle->name() }}</h4>
        </div>
        @include('admin.vehicle.dashboard-summary')
      </div>
      <div class="col-lg-9 col-md-7 col-sm-7">
        <div class="well">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-5">
                  @if(!empty(session()->get('status')['info']))
                    @foreach(session()->get('status')['info'] as $message)
                      <div class="alert alert-success" style="margin-top: 22px">
                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
                      </div>
                    @endforeach
                  @endif
                  <div class="col-md-12">
                    <h3>Overall past hires</h3>
                    <h5>{{ $pastHires->count() }} hire(s) in total</h5>
                    <div id="overall_vehicle_hires_per_month" class="row"></div>
                    @columnchart('Overall Hires per month', 'overall_vehicle_hires_per_month')
                  </div>
                </div>
                <div class="col-md-4">
                  <h3>Vehicle statistics</h3>
                  <table class="table table-condensed">
                    <tr>
                      <th>Total made</th>
                      <th>Date added</th>
                      <th>Date discontinued</th>
                    </tr>
                    <tr>
                      <td>£{{ $vehicle->getTotalProfit() }}</td>
                      <td>{{ date('j/M/Y H:ia', strtotime($vehicle->created_at)) }}</td>
                      <td>{{ date('j/M/Y H:ia', strtotime($vehicle->deleted_at)) }}</td>
                    </tr>
                  </table>
                  {{ Form::open(['route' => ['admin.vehicle.recontinue', $vehicle->id], 'method' => 'patch', 'id' => 'vehicle_recontinue_form']) }}
                  {{ Form::close() }}
                  {{ Form::open(['route' => ['admin.vehicle.delete', $vehicle->id], 'method' => 'delete', 'id' => 'vehicle_delete_form']) }}
                  {{ Form::close() }}
                  <div class="row">
                    <div class="col-md-8 col-xs-12">
                      <div class="btn-group btn-group-justified" style="float: right">
                        <div class="btn-group">
                          <button type="submit" form="vehicle_recontinue_form" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Re-continue</button>
                        </div>
                        <div class="btn-group">
                          <button type="submit" form="vehicle_delete_form" class="btn btn-primary"><span class="glyphicon glyphicon-trash"></span>&nbsp;&nbsp;Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @if($vehicle->getIncompleteHires()->isNotEmpty())
                    @include('admin.vehicle.list-incomplete-hires')
                  @endif
                  @include('admin.vehicle.list-inactive-hires')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection