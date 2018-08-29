@extends('layouts.admin-main')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="well">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3>Users</h3>
              <h5>{{ $users->count() }} user(s) in total</h5>
            </div>
            <div class="scrollable-table">
              <table class="table table-condensed panel-table">
                <thead>
                  <tr>
                    <th class="first">Name</th>
                    <th>E-Mail</th>
                    <th>Date created</th>
                    <th>Last changed</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                  <tr>
                    <td class="first">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ date('j/M/Y H:ia', strtotime($user->created_at)) }}</td>
                    <td>{{ date('j/M/Y H:ia', strtotime($user->updated_at)) }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection