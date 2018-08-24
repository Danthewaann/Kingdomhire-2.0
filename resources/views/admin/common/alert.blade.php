@if(session()->has('status'))
  @foreach(session()->get('status') as $message)
    <div class="alert alert-success alert-dismissible fade in" id="status-alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;{{ $message }}
    </div>
  @endforeach
@endif