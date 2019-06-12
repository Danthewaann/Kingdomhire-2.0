@if(session()->has('errors'))
  <div class="alert alert-danger alert-dismissible fade in" id="status-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{{ $error_message }}</strong>
  </div>
@endif