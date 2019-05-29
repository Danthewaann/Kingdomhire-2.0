@if(Lava::exists('ColumnChart', 'Overall Hires per month'))
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Yearly hires chart</h3>
      <h5>Shows hires per month per year</h5>
    </div>
    <div class="panel-body">
      <div id="overall_hires_per_month"></div>
      @columnchart('Overall Hires per month', 'overall_hires_per_month')
    </div>
  </div>
@endif