<div id="{{ str_replace(" ", "-", $vehicle->name()) }}" class="modal">
  <span class="close-modal cursor" onclick="closeModal('{{ str_replace(" ", "-", $vehicle->name()) }}')"><span class="glyphicon glyphicon-remove"></span></span>
  <div class="modal-content">
    @for($i = 0; $i < count($vehicle->images); $i++)
      <div class="mySlides {{ str_replace(" ", "-", $vehicle->name()).'-images' }}">
        <div class="numbertext">{{ $i+1 }} / {{ count($vehicle->images) }}</div>
        <img src="{{ $vehicle->images[$i]->image_uri }}" style="width:100%; max-height: 600px">
      </div>
    @endfor
      @if(count($vehicle->images) > 1)
        <a class="prev text-link" onclick="plusSlides(-1, '{{ str_replace(" ", "-", $vehicle->name()).'-images' }}')">&#10094;</a>
        <a class="next text-link" onclick="plusSlides(1, '{{ str_replace(" ", "-", $vehicle->name()).'-images' }}')">&#10095;</a>
      @endif
  </div>
</div>