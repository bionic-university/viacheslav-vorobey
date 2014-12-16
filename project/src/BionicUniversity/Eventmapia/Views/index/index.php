<div class="container-fluid">
    <div class="row">

        <div id="map-canvas"></div>

        <div class="col-xs-5" id="left">
            <br>
            <?php foreach($this->events as $event) : ?>
            <ul class="list-group">
                <li class="list-group-item active">
                    <span class="list-group-item-heading"> <a href="#"><?= $event['title']; ?></a> </span>
                    <span class="label label-success pull-right"><?= $event['date']; ?></span>
                </li>
                <li class="list-group-item">
                    <?= nl2br($event['description']); ?>
                    <hr> <span class="small">Created by: <a href="/web/user/view/<?= $event['user_id']; ?>" class="text-info"><?= $event['username']; ?></a></span>
                    <span class="pull-right" style="margin-top: -4px;">
                        <a href="/web/events/view/<?= $event['id']; ?>" class="btn btn-default" style="padding: 3px 20px;">More</a>
                    </span>
                </li>
            </ul>
            <?php endforeach; ?>

            <a href="/web/calendar/index" class="center-block btn btn-primary">Show all events</a><br>

        </div>
        <div class="col-xs-7"></div>

    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script>
    var map, directionsDisplay;
    var directionsService = new google.maps.DirectionsService();

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var mapOptions = {
            center: new google.maps.LatLng(48.5, 31.2),
            zoom:6
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(50.45, 30.52),
            map: map,
            title: 'Eventmapia: Kyiv, Ukraine'
        });
        marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);


    $(function() {
        $('div').click(function(){
            $('#map-canvas').css('position', 'fixed');
        });
    });

</script>
