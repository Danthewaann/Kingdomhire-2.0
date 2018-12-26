$(document).ready(function () {
    $('.vehicle-open-modal').click(function () {
        var vehicle = $(this).data('vehicle');
        document.getElementById(vehicle).style.display = 'block';
        showSlides(1, vehicle);
    });

    $('.vehicle-close-modal').click(function () {
        var vehicle = $(this).data('vehicle');
        document.getElementById(vehicle).style.display = 'none';
    });

    $('.modal-prev').click(function () {
        var vehicle = $(this).data('vehicle');
        plusSlides(-1, vehicle + '-images');
    });

    $('.modal-next').click(function () {
        var vehicle = $(this).data('vehicle');
        plusSlides(1, vehicle + '-images');
    });
});

var slideIndex = 1;

// Next/previous controls
function plusSlides(n, vehicle_id) {
    showSlides(slideIndex += n, vehicle_id);
}

// Thumbnail image controls
function currentSlide(n, vehicle_id) {
    showSlides(slideIndex = n, vehicle_id);
}

function showSlides(n, vehicle_id) {
    var i;
    var slides = document.querySelectorAll('.'+vehicle_id+'-images');
    console.log(slides, vehicle_id);
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}