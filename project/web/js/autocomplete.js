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
    },

    // Add via point
    'addViaPoint' : function(e) {
        e.preventDefault();
        Events.viaCounter += 1;

        $(this).before('<div class="form-group"> <div class="form-inline">' +
        '<input type="text" name="routeVia[]" placeholder="Via" class="form-control" id="via-autocomplete-input-'+ Events.viaCounter +'" style="width: 90%;">' +
        '<a href="#" class="btn btn-danger btn-delete pull-right" style="font-size: 12px; line-height: 1.6;">x</a>' +
        '</div></div>');
    },

    // Delete via point
    'deleteViaPoint' : function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    },

};
