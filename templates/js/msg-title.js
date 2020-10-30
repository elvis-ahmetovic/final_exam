//Show & hide message title change form in control panel

$(document).ready(function () {
    // Open form
    $('#changeTitleBtn').click(function () {
        $(this).hide();
        $('#title').hide();
        $('#changeTitleForm').addClass('d-flex');
    });

    // Close form
    $('#closeTitle').click(function () {
        $('#changeTitleForm').removeClass('d-flex');
        $('#title').show();
        $('#changeTitleBtn').show();
    });
});