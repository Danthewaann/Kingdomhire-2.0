<div id="{{ $vehicle->slug }}" class="img-modal">
  <span class="close-modal cursor" onclick="closeModal('{{ $vehicle->slug }}')"><span class="glyphicon glyphicon-remove"></span></span>
  <div class="img-modal-content">
    @for($i = 0; $i < count($vehicle->images); $i++)
      <div class="modal-slides {{ $vehicle->slug.'-images' }}">
        <div class="numbertext">{{ $i+1 }} / {{ count($vehicle->images) }}</div>
        <img src="{{ $vehicle->images[$i]->image_uri }}" style="width:100%; max-height: 600px">
      </div>
    @endfor
      @if(count($vehicle->images) > 1)
        <a class="modal-prev text-link" onclick="plusSlides(-1, '{{ $vehicle->slug.'-images' }}')">&#10094;</a>
        <a class="modal-next text-link" onclick="plusSlides(1, '{{ $vehicle->slug.'-images' }}')">&#10095;</a>
      @endif
  </div>
</div>