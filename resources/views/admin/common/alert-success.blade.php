@if(session()->has('status'))
  <div class="alert alert-success alert-dismissible fade in" id="status-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    @if(is_array(session()->get('status')))
      @foreach(session()->get('status') as $message)
        @if($loop->first)
          <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;<strong>{{ $message }}</strong><br>
        @else
          {{ $message }}<br>
        @endif
      @endforeach
    @else
      <span class="glyphicon glyphicon-info-sign"></span>&nbsp;&nbsp;<strong>{{ session()->get('status') }}</strong><br>
    @endif
  </div>
@endif