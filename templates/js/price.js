/* Change price on coach panel */

$(document).ready(function () {
    // Open form
    $('#changePriceBtn').click(function () {
        $(this).hide();
        $('#priceVal').hide();
        $('#changePrice').addClass('d-flex');
    });

    // Close form
    $('#closePrice').click(function () {
        $('#changePriceBtn').show();
        $('#priceVal').show();
        $('#changePrice').removeClass('d-flex');
    });
});