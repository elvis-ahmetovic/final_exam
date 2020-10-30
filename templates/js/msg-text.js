//Show & hide message title change form in control panel

$(document).ready(function () {
    // Open form
    $('#changeTexteBtn').click(function () {
        $(this).hide();
        $('#textMsg').hide();
        $('#changeTexteForm').addClass('d-flex');
    });

    // Close form
    $('#closeText').click(function () {
        $('#changeTexteForm').removeClass('d-flex');
        $('#textMsg').show();
        $('#changeTexteBtn').show();
    });
});