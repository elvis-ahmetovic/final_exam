// Nova poruka


$(document).ready(function () {
    $('#new-message').click(function () {
        if ($('.new-message').hasClass('d-none')) {
            $('.new-message').removeClass('d-none');
            $('.conversations').addClass('d-none');
            $('.conv-messages').addClass('d-none');
            $('.priv-msgs').removeClass('flex-md-row');
            $('#new-message').text('Back');
        } else {
            $('.new-message').addClass('d-none');
            $('.conversations').removeClass('d-none');
            $('.conv-messages').removeClass('d-none');
            $('.priv-msgs').addClass('flex-md-row');
            $('#new-message').text('New Message');
        }
    });
});
