// Validation Admins new passwords

$(document).ready(function(){

    // No white space
    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "White space not allowed");

    $("#adminPassForm").validate({
      rules: {
        newAdminPass: {
          required: true,
          nowhitespace: true,
          minlength: 6,
        },
        reNewAdminPass: {
          required: true,
          equalTo: "#newAdminPass",
        },
      },
      messages: {
        newAdminPass: {
          required: "This field is required",
          minlength: "Minimum 6 charactes",
        },
        reNewAdminPass: {
          required: "This field is required",
          equalTo: "Password doesn't match",
        },
      },
      submitHandler: function (form) {
        form.submit();
      },
    });

    
});