/**
 * Eventmapia
 * https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */

// EventsController
var Events = {

    'viaCounter': 0,

    'init': function() {
        $('#btn-add-via-point').click(Events.addViaPoint);
        $(document).on('click', '.btn-delete', Events.deleteViaPoint);
        $('#btn-add-refresh-direction').click(Events.refreshDirection);
    },

    // Add via point
    'addViaPoint' : function(e) {
        e.preventDefault();
        Events.viaCounter += 1;

        $(this).parent().before('<div class="form-group"> <div class="form-inline">' +
        '<input type="text" name="routeVia[]" placeholder="Via" class="form-control" id="via-autocomplete-input-'+ Events.viaCounter +'" style="width: 90%;">' +
        '<a href="#" class="btn btn-danger btn-delete pull-right" style="font-size: 12px; line-height: 1.6;"><i class="glyphicon glyphicon-remove"></i> </a>' +
        '</div></div>');

        $('#map-canvas').css('position', 'fixed');
    },

    // Delete via point
    'deleteViaPoint' : function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    },

    // Refresh direction
    'refreshDirection' : function(e) {
        e.preventDefault();

        var start = $('#place-autocomplete-input1').val();
        var end = $('#place-autocomplete-input2').val();
        var selectedMode = $('input[type=radio]:checked').val();
        console.log(selectedMode);
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode[selectedMode]
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
    }
};


// CalendarController
var Calendar = {

    'renderCalendar' : function(calendarId) {
        calendarId.fullCalendar({
            timeFormat: 'H(:mm)',
            lang: 'en',
            contentHeight: 550,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek'   //agendaDay'
            },
            eventLimit: true,               // allow "more" link when too many events

            eventMouseover: function(calEvent, jsEvent, view) {
                var tooltip = '<div class="event-tooltip">' + calEvent.description + '</div>';
                $("body").append(tooltip);
                $(this).mouseover(function(e) {
                    $(this).css('z-index', 10000);
                    $('.event-tooltip').fadeIn('500');
                    $('.event-tooltip').fadeTo('10', 1.9);
                }).mousemove(function(e) {
                    $('.event-tooltip').css('top', e.pageY + 10);
                    $('.event-tooltip').css('left', e.pageX + 20);
                });
            },

            eventMouseout: function(calEvent, jsEvent) {
                $(this).css('z-index', 8);
                $('.event-tooltip').remove();
            },

            events: '/web/calendar/events'
        })
    }

};
