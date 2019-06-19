<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Admin | Kingdomhire - Car & Van Rental Agency</title>

  <!-- Styles -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swatkins/gantt/css/gantt.css') }}" rel="stylesheet" type="text/css">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=sxQYcq">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=sxQYcq">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=sxQYcq">
  <link rel="manifest" href="/site.webmanifest?v=sxQYcq">
  <link rel="mask-icon" href="/safari-pinned-tab.svg?v=sxQYcq" color="#339966">
  <link rel="shortcut icon" href="/favicon.ico?v=sxQYcq">
  <meta name="msapplication-TileColor" content="#339966">
  <meta name="theme-color" content="#2c885a">
</head>
<body>
  <div id="modals">
    @if(!empty($reservations))
      @foreach($reservations->sortBy('end_date') as $reservation)
        @include('admin.reservation.destroy-modal')
      @endforeach
    @endif
    @if(!empty($activeHires))  
      @foreach($activeHires->sortByDesc('end_date') as $hire)
        @include('admin.hire.destroy-modal')  
      @endforeach
    @endif
    @if(!empty($inactiveHires))
      @foreach($inactiveHires->sortByDesc('end_date') as $hire)
        @include('admin.hire.destroy-modal')  
      @endforeach
    @endif
    @if(!empty($weeklyRates))
      @foreach($weeklyRates as $weeklyRate)
        @include('admin.weekly-rate.destroy-modal')  
      @endforeach
    @endif
    @if(!empty($vehicleTypes))
      @foreach($vehicleTypes as $vehicleType)
        @include('admin.vehicle-type.destroy-modal')  
      @endforeach
    @endif
    @if(!empty($vehicleFuelTypes))
      @foreach($vehicleFuelTypes as $vehicleFuelType)
        @include('admin.vehicle-fuel-type.destroy-modal')  
      @endforeach
    @endif
    @if(!empty($vehicleGearTypes))
      @foreach($vehicleGearTypes as $vehicleGearType)
        @include('admin.vehicle-gear-type.destroy-modal')  
      @endforeach
    @endif
  </div>
  @include('layouts.admin-navbar-base')
  <main>
    <div class="jumbotron jumbotron-admin">
      <div class="container">
        @yield('content')
      </div>
    </div>
  </main>
  <footer class="jumbotron jumbotron-admin-footer">
    <div class="container">
      <p>&copy; {{ date('Y') }} kingdomhire.com</p>
    </div>
  </footer>


  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset('js/datepicker.js') }}"></script>
  <script src="{{ asset('js/modal-gallery.js') }}"></script>
  @if(Request::is('admin/vehicles/*'))
    <script src="{{ asset('js/vehicle-image-order.js') }}"></script>
  @endif
</body>
</html>
