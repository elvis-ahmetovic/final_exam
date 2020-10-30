// Index page search validation

$(document).ready(function (){

    // Validation search input fiels
    $('#searchform').validate({
        rules: {
            searchcoach: {
                required: true
            }
        },
        messages: {
            searchcoach: {
                required: 'Nema rezultata'
            }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") == "searchcoach") {
                error.appendTo($('#response'));
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
})

