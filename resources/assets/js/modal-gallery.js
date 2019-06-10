$(document).ready(function () {
    $('.vehicle-open-modal').click(function () {
        vehicle = $(this).data('vehicle');
        showModal(vehicle);
    });

    $('.vehicle-close-modal').click(function () {
        vehicle = $(this).data('vehicle');
        closeModal(vehicle);
    });

    $('.modal-prev').click(function () {
        vehicle = $(this).data('vehicle');
        plusSlides(-1, vehicle);
    });

    $('.modal-next').click(function () {
        vehicle = $(this).data('vehicle');
        plusSlides(1, vehicle);
    });

    $(window).click(function(event) {
        var modal = document.getElementById(vehicle);
        if (event.target == modal) {
            closeModal(vehicle);
        }
    });
});

var slideIndex = 1;
var vehicle = null;

function showModal(vehicle) {
    $('#' + vehicle).css('display', 'block');
    showSlides(1, vehicle);
}

function closeModal(vehicle) {
    $('#' + vehicle).fadeOut(300);
    slideIndex = 1;
}

// Next/previous controls
function plusSlides(n, vehicle) {
    showSlides(slideIndex += n, vehicle);
}

// Thumbnail image controls
function currentSlide(n, vehicle) {
    showSlides(slideIndex = n, vehicle);
}

function showSlides(n, vehicle) {
    var i;
    var slides = $('.'+vehicle+'-images');
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

