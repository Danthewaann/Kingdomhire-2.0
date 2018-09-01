<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css">
  {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">--}}
  <title>{{ config('app.name', 'Laravel') }} | Car & Van Hire Specialist</title>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swatkins/gantt/css/gantt.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">
  @include('layouts.admin-navbar-base')

  <div class="jumbotron jumbotron-admin">
    @include('admin.vehicle.summaries.vehicle-dashboard')
    <div class="col-lg-9 col-sm-7">
      @yield('content')
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script>
  $(document).ready(function () {
    $('.dropdown-submenu a.submenu').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
    $( "#start_date" ).datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true,
      zIndexOffset: 1000
    });
    $("#start_date_calender").click(function () {
      $( "#start_date" ).focus();
    });
    $( "#end_date" ).datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true,
      zIndexOffset: 1000
    });
    $("#end_date_calender").click(function () {
      $( "#end_date" ).focus();
    });

    // $('.input-daterange').datepicker({
    //     format: "yy-mm-dd",
    //     todayHighlight: true,
    //     autoclose: true
    //   });
    // });

    // $('.input-daterange input').each(function() {
    //   $(this).datepicker({
    //     format: "yy-mm-dd",
    //     todayHighlight: true,
    //     autoclose: true
    //   });
    // });

    //Might need in the future
    $('#form-modal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var action_for = button.data('for');
      var id = button.data('id');

      var modal = $(this);
      if (action_for === 'reservation') {
        modal.find('.modal-title').text('Cancel Reservation');
        modal.find('.modal-body').text('Are you sure you want to cancel this reservation?');
        modal.find('.modal-body #yes-button')
      }
    });

  });

  $(function () {
    $('[data-toggle="popover"]').popover();
  });
</script>
<script>
  // Open the Modal
  function openModal(id) {
    document.getElementById(id).style.display = "block";
  }

  // Close the Modal
  function closeModal(id) {
    document.getElementById(id).style.display = "none";
  }

  var slideIndex = 1;
  // showSlides(slideIndex);

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
    var slides = document.querySelectorAll('.'+vehicle_id);
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
  }
</script>
{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
{{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
</body>
</html>
