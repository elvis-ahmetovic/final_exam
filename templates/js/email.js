//Show & hide email change form

$(document).ready(function(){
    // Open change form
    $('#changeMailBtn').click(function(){
        $(this).hide();
        $('#mail').hide();
        $('#changeEmailForm').addClass('d-flex');
    });

    // Close form
    $('#closeEmail').click(function(){
        $('#changeEmailForm').removeClass('d-flex');
        $('#mail').show();
        $('#changeMailBtn').show();
    });
});