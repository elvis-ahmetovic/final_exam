/* Open & Close coach panel */

$(document).ready(function () {
    // Open panel
    $('#openCoachPanel').click(function () {
        $('.profile-info').removeClass('d-flex').addClass('d-none');
        $('.note').hide();
        $('.coach-panel').addClass('d-flex');
    });

    //Close panel
    $('#backButton').click(function () {
        $('.profile-info').removeClass('d-none').addClass('d-flex');
        $('.note').show();
        $('.coach-panel').removeClass('d-flex');
    })
});