@if($gantt != null)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Schedule</h3>
            <h5>R = Reservation</h5>
            <h5>H = Active hire</h5>
        </div>
        {!! $gantt !!}
    </div>
@endif