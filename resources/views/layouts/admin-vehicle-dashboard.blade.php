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
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
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
  <div id="vehicle-modals">
    @include('admin.vehicle.modals.image-gallery')
    @includeWhen(!$vehicle->trashed() ,'admin.vehicle.modals.discontinue')
    @include('admin.vehicle.modals.destroy')
    @foreach($vehicle->reservations->sortBy('end_date') as $reservation)
      @include('admin.reservation.destroy-modal')
    @endforeach
    @if($vehicle->hasActiveHire())
      @include('admin.hire.destroy-modal', ['hire' => $vehicle->getActiveHire()]) 
    @endif
    @foreach($vehicle->getInactiveHires()->sortByDesc('end_date') as $hire)
      @include('admin.hire.destroy-modal')  
    @endforeach
  </div>
  @include('layouts.admin-navbar-base')
  <main>
    <div class="jumbotron jumbotron-admin">
      <div class="container">
        <div class="row">
          @if(session()->has('status'))
            <div class="col-lg-12">
              @include('admin.common.alert-success')
            </div>
          @endif
          @include('admin.vehicle.summaries.vehicle-dashboard')
          <div class="col-lg-8 col-md-8 col-sm-6">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="jumbotron jumbotron-admin-footer">
    <div class="container">
      <p>&copy; {{ date('Y') }} kingdomhire.com</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ mix('js/datepicker.js') }}"></script>
  <script src="{{ mix('js/modal-gallery.js') }}"></script>
  @if(Request::is('admin/vehicles/*'))
    <script>
      var images = {!! json_encode($vehicle->images->toArray()) !!};
      var site_name = "{{ env('APP_URL', '') }}/";
    </script>
    <script src="{{ mix('js/vehicle-image-order.js') }}"></script>
  @endif
</body>
</html>
