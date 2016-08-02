/**
 * Custom JS functions.
 */

/**
 * Runs maintenance OPs; runs methods to declare maintenance as complete and remove it from line-up.
 */
$('.v_tasks').on('click', 'button', function () {
    RunMaintenanceOps(
        $(this),
        $(this).attr('data-type'),
        $(this).attr('data-op'),
        $(this).attr('data-v_id'),
        $(this).attr('data-vehicle_type')
    );
});

/**
 * Dispatches request to server for relevant request.
 *
 * @param givenElement Given object in DOM on which we are running an action
 * @param type         Service type (Gasoline, diesel or electric maintenance)
 * @param op           Operation to carry out (rotate tires, charge battery etc)
 * @param vehicleId    System ID of the given vehicle
 * @param vehicleType  Veicle type (Gasoline, diesel, electric for now)
 */
function RunMaintenanceOps(givenElement, type, op, vehicleId, vehicleType) {
    var msgContainer = $('#' + vehicleType + '_result_msg');
    $.ajax({
        url: 'runops.php?type=' + type + '&op=' + op + '&vehicle_id=' + vehicleId,
        type: "GET",
        cache: false,
        dataType: 'JSON',
        success: function (response) {
            msgContainer.html(response.msg);
            if ('success' === response.flag) {
                msgContainer.css('color', 'green');
                if ('complete_maintenance' === op) {
                    $('#' + vehicleType + '_tasks_' + vehicleId).html('');
                    $('#' + vehicleType + '_tasks_' + vehicleId).html(
                        '<button class="btn-xs btn-primary vehicle_chkout" data-type="' + type + '" data-op="checkout_vehicle"' +
                        'data-v_id="' + vehicleId + '" data-vehicle_type="' + vehicleType + '">Check Out</button>'
                    );
                } else if ('checkout_vehicle' === op) {
                    givenElement.closest('tr').hide();
                }
            } else {
                msgContainer.css('color', 'red');
            }
        }
    });
}

/**
 * Dispatches the request to add a vehicle.
 */
$('#add_v_form').submit(function (event) {
    event.preventDefault();
    var $form = $(this);
    var serializedData = $form.serialize();
    $.ajax({
        url: 'runops.php',
        type: "POST",
        data: serializedData,
        success: function(response) {
            var jsonResponse = $.parseJSON(response);
            $('#add_v_result_msg').html(jsonResponse.msg);
            if ('success' === jsonResponse.flag) {
                $('#add_v_result_msg').css('color', 'green');
                $( '#add_v_form' )[0].reset();
            } else {
                $('#add_v_result_msg').css('color', 'red');
            }
        }
    })
});