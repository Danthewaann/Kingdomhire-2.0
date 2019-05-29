@if(Lava::exists('BarChart', 'Vehicle Reservations'))
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Reservations chart</h3>
      <h5>Shows reservations per vehicle</h5>
    </div>
    <div class="panel-body">
      <div id="vehicle_reservations"></div>
      @barchart('Vehicle Reservations', 'vehicle_reservations')
    </div>
  </div>
@endif