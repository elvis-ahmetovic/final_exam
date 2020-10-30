
$(document).ready(function () {

    // Only letters
    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[A-Za-zčćžđšČĆŽŠĐ]+$/g.test(value);
    }, "Letters only");

    // Validation search input fiels
    $("#contact_form").validate({
      rules: {
        name: {
          required: true,
          minlength: 4,
          lettersonly: true,
        },
        lastname: {
          required: true,
          minlength: 4,
          lettersonly: true,
        },
        email: {
          required: true,
          email: true,
        },
        text: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "This field is required",
          minlength: "Minimum length 4 caracters",
          lettersonly: "Letters only",
        },
        lastname: {
          required: "This field is required",
          minlength: "Minimum length 4 caracters",
          lettersonly: "Letters only",
        },
        email: {
          required: "This field is required",
          email: "Please enter a valid email",
        },
        text: {
          required: "This field is required",
        },
      },
    });

})