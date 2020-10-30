/* Change phone on coach panel */

$(document).ready(function () {
    // Open form
    $('#changeTelBtn').click(function () {
        $(this).hide();
        $('#phoneNum').hide();
        $('#changeTel').addClass('d-flex');
    });

    // Close form
    $('#closeTel').click(function () {
        $('#changeTelBtn').show();
        $('#phoneNum').show();
        $('#changeTel').removeClass('d-flex');
    });
});