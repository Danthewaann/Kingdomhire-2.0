<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @if(Request::is('/') || Request::is('home'))
    <title>Welcome | Kingdomhire - Car & Van Rental Agency</title>
    <meta name="description" content="Car & Van Rental Agency Based in Armagh, Northern Ireland. We provide a wide range of vehicles to rent. Contact us if you are interested in renting from us.">
  @elseif(Request::is('vehicles'))
    <title>Our Fleet Of Vehicles | Kingdomhire - Car & Van Rental Agency</title>
    <meta name="description" content="Our fleet includes Hatchbacks, Large Vans, Small Vans, People Carriers (MPVs), Convertibles and more. Contact us to see what we have available.">
  @elseif(Request::is('contact-us'))
    <title>Our Contact Info & Directions | Kingdomhire - Car & Van Rental Agency</title>
    <meta name="description" content="Want to rent a vehicle from us? Need to get directions to Kingdomhire? All our contact information is available on this page">
  @else
    <title>Welcome | Kingdomhire - Car & Van Rental Agency</title>
    <meta name="description" content="Car & Van Rental Agency Based in Markethill, Co. Armagh. We provide a wide range of vehicles to rent. Contact us if you are interested in renting from us.">
  @endif

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
  @if(Request::is('vehicles'))
    <div id="vehicle-images-container">
      @foreach($jsonVehicles as $vehicle)
        @if($vehicle->images->count() > 0)
          @include('admin.vehicle.modals.image-gallery')
        @endif
      @endforeach
    </div>
  @endif  
  @include('layouts.public-navbar')
  <main>
    @yield('content')
  </main>
  <footer class="jumbotron jumbotron-footer">
    <div class="container">
      <p>&copy; {{ date('Y') }} kingdomhire.com</p>
    </div>
  </footer>
  <script src="{{ asset('js/app.js') }}"></script>
  @if(Request::is('vehicles'))
    <script>
      var vehicles = {!! json_encode($jsonVehicles->toArray()) !!};
      var site_name = "{{ env('APP_URL', '') }}/";
    </script>
    <script src="{{ asset('js/vehicle-search.js') }}"></script>
    <script src="{{ asset('js/modal-gallery.js') }}"></script>
  @endif
  @if(Request::is('contact-us'))
    {!! NoCaptcha::renderJs() !!}
  @endif
</body>
</html>
