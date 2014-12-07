<div class="form-group">
    <input type="text" name="routeFrom" placeholder="From" class="form-control" id="place-autocomplete-input" autocomplete="off">
</div>

<?= $this->script; ?>

<div class="container-fluid">
    <div class="row">

        <?= $this->map; ?>
        <div class="col-xs-5" style="padding-top: 10px;">

            <form action="/web/events/add" method="post">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add new event</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="Title" />
                        </div>
                        <div class="form-group">
                            <textarea rows="5" class="form-control" name="description" placeholder="Description"></textarea>
                        </div>
                        <div class="form-inline">
                            <input type="text" class="form-control" name="date" placeholder="Start date" />
                            &nbsp;&nbsp;
                            <div class="checkbox">
                                <label>
                                    <input id="add-to-google-calendar" type="checkbox" checked="checked"> Add event to Google calendar
                                </label>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <input type="text" name="routeFrom" placeholder="From" class="form-control" id="place-autocomplete-input1" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="routeTo" placeholder="To" class="form-control" id="place-autocomplete-input2">
                        </div>
                        <a href="#" class="btn btn-default" id="btn-add-via-point">Add via point</a>

                        <hr>

                        <button type="submit" name="submit" class="btn btn-primary pull-right" id="btn-add-submit">Add event</button>
                    </div>
                </div>
            </form>

        </div>


        <div class="col-xs-7">
            <input id="pac-input" class="controls" type="text" placeholder="Enter a location" autocomplete="off" style="z-index: 0; position: absolute; left: 88px; top: 0px;">
            <div id="type-selector" class="controls" style="z-index: 0; position: absolute; left: 488px; top: 0px;">
                <input type="radio" name="type" id="changetype-all" checked="checked">
                <label for="changetype-all">All</label>

                <input type="radio" name="type" id="changetype-address">
                <label for="changetype-address">Addresses</label>

                <input type="radio" name="type" id="changetype-geocode">
                <label for="changetype-geocode">Geocodes</label>
            </div>
        </div>

    </div>
</div>


<style>
    .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-weight: 300;
        font-family: Roboto;
    }
</style>

<script>
    $(function() {

        function initialize() {
            var routeFrom = document.getElementById('place-autocomplete-input1');
            var routeTo = document.getElementById('place-autocomplete-input2');
            var acFrom = new google.maps.places.Autocomplete(routeFrom);
            var acTo = new google.maps.places.Autocomplete(routeTo);
        }
        google.maps.event.addDomListener(window, 'load', initialize);

        // Add via point
        $('#btn-add-via-point').click(function(e) {
            e.preventDefault();

            $(this).before('<div class="form-group"> <div class="form-inline">' +
            '<input type="text" name="routeVia[]" placeholder="Via" class="form-control" style="width: 90%;">' +
            '<a href="#" class="btn btn-danger btn-delete pull-right" style="font-size: 12px; line-height: 1.6;">x</a>' +
            '</div></div>');
        });

        // Delete via point
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });


    });

</script>


