// Validation Users new passwords

$(document).ready(function(){

    // No white space
    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "White space not allowed");

    $('#passChangeForm').validate({
        rules: {
            newPass: {
                required: true,
                nowhitespace: true,
                minlength: 6
            },
            reNewPass: {
                required: true,
                equalTo: "#newPass"
            }
        },
        messages: {
            newPass: {
                required: 'Please enter password',
                minlength: 'Minimum 6 characters'
            },
            reNewPass: {
                required: 'Please repeat password',
                equalTo: 'Password doesn´t match'
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    
});