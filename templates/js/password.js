//Show & hide password change form

$(document).ready(function () {
    // Open form
    $('#changePassBtn').click(function () {
        $(this).hide();
        $('#passChangeForm').addClass('d-flex');
    });

    // Close form
    $('#closePassForm').click(function () {
        $('#passChangeForm').removeClass('d-flex');
        $('#changePassBtn').show();
    });
});