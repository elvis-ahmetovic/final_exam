$(document).ready(function () {

    // Onlly letters and space
    $.validator.addMethod("lettersspace", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
    }, "Letters only");

    $('#changeCityForm').validate({
        rules: {
            newCity: {
                required: true,
                lettersspace: true,
                minlength: 4
            }
        },
        messages: {
            newCity: {
                required: 'Type a city name',
                minlength: 'Minimum 4 characters'
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    })
})