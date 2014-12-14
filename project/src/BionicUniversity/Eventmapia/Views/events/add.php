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
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="date" placeholder="Start date" id="datepicker-1">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="endDate" placeholder="End date" id="datepicker-2">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="text" name="routeFrom" placeholder="From" class="form-control" id="place-autocomplete-input1" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="routeTo" placeholder="To" class="form-control" id="place-autocomplete-input2">
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
        <div class="col-xs-7"></div>

    </div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
<script src="/web/js/vendor/moment.min.js"></script>
<script src="/web/js/vendor/bootstrap-datetimepicker.min.js"></script>
<script src="/web/js/vendor/locale-uk.js"></script>

<script>
    var map, directionsDisplay;
    var directionsService = new google.maps.DirectionsService();

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

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    $(document).ready(function() {
        Events.init();

        // Autocomplete
        $('#place-autocomplete-input1').change(Events.refreshDirection);
        $('#place-autocomplete-input2').change(Events.refreshDirection);

        // DatetimePicker
        $('#datepicker-1').datetimepicker({
            language: 'uk'
        });
        $('#datepicker-2').datetimepicker({
            language: 'uk'
        });
    });
</script>
