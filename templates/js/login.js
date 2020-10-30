/* hide and show login div */
$(document).ready(function(){
    $('.login').click(function(){
        $('.log-reg').removeClass('d-flex');
        $('.log-reg').hide();
        $('.login-div').addClass('d-flex');
    });

    $('#backButton').click(function(){
        $('.log-reg').addClass('d-flex');
        $('.log-reg').show();
        $('.login-div').removeClass('d-flex');
    });
});
