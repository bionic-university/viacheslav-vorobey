<div class="container-fluid">
    <div class="row">

        <div id="map-canvas"></div>

        <div class="col-xs-5" style="padding-top: 10px;">

            <form action="/web/events/add" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add new event</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <textarea rows="5" class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-inline">
                            <input type="text" class="form-control" name="date" placeholder="Start date">
                            &nbsp;&nbsp;
                            <div class="checkbox">
                                <label>
                                    <input id="add-to-google-calendar" type="checkbox" checked="checked"> Add event to Google calendar
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <input type="text" name="routeFrom" placeholder="From" class="form-control" id="place-autocomplete-input1" autocomplete="off" onchange="calcRoute()">
                        </div>
                        <div class="form-group">
                            <input type="text" name="routeTo" placeholder="To" class="form-control" id="place-autocomplete-input2" onchange="calcRoute()">
                        </div>
                        <div class="form-inline">
                            <a href="#" class="btn btn-default" id="btn-add-via-point">Add via point</a>
                            <a href="#" class="btn btn-success" id="btn-add-refresh-direction"><!--i class="glyphicon glyphicon-refresh"></i--> Refresh direction</a>
                            <div class="radio pull-right" style="padding-left: 20px;">
                                <label> <input type="radio" class="form-control" name="mode[]" value="DRIVING" checked="checked" style="margin: 0"> Driving </label> &nbsp;&nbsp;
                                <label> <input type="radio" class="form-control" name="mode[]" value="BICYCLING" style="margin: 0"> Bicycling </label> &nbsp;&nbsp;
                                <label> <input type="radio" class="form-control" name="mode[]" value="WALKING" style="margin: 0"> Walking </label>
                            </div>
                        </div>

                        <hr>

                        <button type="submit" name="submit" class="btn btn-primary pull-right" id="btn-add-submit">Add event</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-xs-7"> </div>

    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script src="/web/js/autocomplete.js"></script>
<script>

    $(document).ready(function() {
        Events.init();
    });

</script>

<script>

    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    var routeFrom, routeTo;
    var lngLat = [];

    function createObj() {
        routeFrom = new google.maps.places.Autocomplete(document.getElementById('place-autocomplete-input1'));
        routeTo = new google.maps.places.Autocomplete(document.getElementById('place-autocomplete-input2'));
    }

    function saveLatLng() {
        createObj();

        setInterval(function() {
            var from = routeFrom.getPlace();
            var to = routeFrom.getPlace();

            if (!from.geometry && !to.geometry) {
                return;
            }

            console.log('from: ' + from.geometry.location);
            console.log(from);

            console.log('to: ' + to.geometry.location);
            console.log(to);
        }, 5000);
    }

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var mapOptions = {
            center: new google.maps.LatLng(48.5, 31.2),
            zoom:6
        };

        var searchField = document.getElementById('place-autocomplete-input1');
        var searchOptions = [];
        routeFrom = new google.maps.places.Autocomplete(searchField, searchOptions);
        routeTo = new google.maps.places.Autocomplete(document.getElementById('place-autocomplete-input2'));

        google.maps.event.addListener(routeFrom, 'place_changed', function() {
            var from = routeFrom.getPlace();
            if (!from.geometry) {
                return;
            }
            lngLat.push(from.geometry.location);
        });

        google.maps.event.addListener(routeTo, 'place_changed', function() {
            var to = routeTo.getPlace();
            if (!to.geometry) {
                return;
            }
            lngLat.push(to.geometry.location);
        });




        //var autocompleteSearch = new google.maps.places.Autocomplete(searchField, searchOptions);

        console.log(lngLat);

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
    }

    function calcRoute() {
        var start = document.getElementById('place-autocomplete-input1').value;
        var end = document.getElementById('place-autocomplete-input2').value;
        var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    $(document).ready(function() {
        $('#btn-add-submit').click(function (e) {

            e.preventDefault();
            //createObj();

            var routeFrom = new google.maps.places.Autocomplete(document.getElementById('place-autocomplete-input1'));
            var routeTo = new google.maps.places.Autocomplete(document.getElementById('place-autocomplete-input2'));

            // Save lat & lng to array
            //var from = routeFrom.getPlace();
            //var to = routeTo.getPlace();
            //if (!from.geometry && !to.geometry) {
            //    return;
            //}
            //lngLat.push(from.geometry.location);
            //lngLat.push(to.geometry.location);

            console.log(lngLat);
        });
    });
</script>