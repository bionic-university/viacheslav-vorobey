<div class="container-fluid">
    <div class="row">
        <div class="col-xs-offset-1 col-xs-10">

            <br>
            <div id="event-calendar"></div>

        </div>
    </div>
</div>

<script src="/web/js/vendor/moment.min.js"></script>
<script src="/web/js/vendor/fullcalendar.min.js"></script>

<script>
    $(document).ready(function() {
        Calendar.renderCalendar($('#event-calendar'));
    });
</script>
