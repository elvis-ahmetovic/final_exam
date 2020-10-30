/* Change category on coach panel */

$(document).ready(function(){
    // Open form
    $('#changeCategoryBtn').click(function(){
        $(this).hide();
        $('#catName').hide();
        $('#changeCategory').addClass('d-flex');
    });

    // Close form
    $('#closeCategory').click(function () {
        $('#changeCategoryBtn').show();
        $('#catName').show();
        $('#changeCategory').removeClass('d-flex');
    });
});