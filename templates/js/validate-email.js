$(document).ready(function(){

    // No white space
    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "White space not allowed");

    $("#changeEmailForm").validate({
      rules: {
        newEmail: {
          required: true,
          nowhitespace: true,
          email: true,
          remote: {
            url: "validateNewEmail.php",
            type: "post",
            dataType: "json",
            data: {
              email: function () {
                return $("#newEmail").val();
              },
            },
          },
        },
      },
      messages: {
        newEmail: {
          required: "Please enter email",
          email: "Please enter a valid email",
          remote: "Email already exists",
        },
      },
      submitHandler: function (form) {
        form.submit();
      },
    });
})