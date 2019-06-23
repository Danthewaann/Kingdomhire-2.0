<div id="{{ $vehicle->slug }}" class="img-modal">
  <span class="close-modal cursor vehicle-close-modal" data-vehicle="{{ $vehicle->slug }}"><span class="glyphicon glyphicon-remove"></span></span>
  <div class="img-modal-content">
    @for($i = 0; $i < count($vehicle->images); $i++)
      <div class="modal-slides {{ $vehicle->slug.'-images' }}">
        <div class="numbertext">{{ $i+1 }} / {{ count($vehicle->images) }}</div>
        <img src="{{ asset($vehicle->images[$i]->image_uri) }}" alt="{{ $vehicle->name() . ' - ' . $vehicle->images[$i]->name }}">
      </div>
    @endfor
      @if(count($vehicle->images) > 1)
        <a class="modal-prev text-link-arrow" data-vehicle="{{ $vehicle->slug }}">&#10094;</a>
        <a class="modal-next text-link-arrow" data-vehicle="{{ $vehicle->slug }}">&#10095;</a>
      @endif
  </div>
</div>