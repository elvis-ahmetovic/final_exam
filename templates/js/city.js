//Show & hide city change form

$(document).ready(function () {
    // Open form
    $('#changeCityBtn').click(function () {
        $(this).hide();
        $('#city').hide();
        $('#changeCityForm').addClass('d-flex');
    });

    // Close form
    $('#closeCity').click(function () {
        $('#changeCityForm').removeClass('d-flex');
        $('#city').show();
        $('#changeCityBtn').show();
    });
});