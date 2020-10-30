/* Open & Close advertise panel */

$(document).ready(function(){
    // Open panel
    $('#openAdsPanel').click(function(){
        $('.profile-info').removeClass('d-flex').addClass('d-none');
        $('.note').hide();
        $('.advertise').addClass('d-flex');
    });

    //Close panel
    $('.back-button').click(function(){
        $('.profile-info').removeClass('d-none').addClass('d-flex');
        $('.note').show();
        $('.advertise').removeClass('d-flex');
    })
});