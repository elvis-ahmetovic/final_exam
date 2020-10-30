//Show & hide avatar change form

$(document).ready(function(){
    $('#changeAvatarBtn').click(function(){
        $(this).hide();
        $('#pfofileAvatar').hide();
        $('#newAvatar').addClass('d-flex');
    });

    $('#closeAvatar').click(function(){
        $('#changeAvatarBtn').show();
        $('#pfofileAvatar').show();
        $('#newAvatar').removeClass('d-flex');
    });
})