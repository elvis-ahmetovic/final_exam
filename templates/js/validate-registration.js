
// Registration validation

$(document).ready(function(){

    // Date validation
    $.validator.addMethod("date", function (value, element) {
        var check = false,
            re = /^\d{1,2}\/\d{1,2}\/\d{4}$/,
            adata, gg, mm, aaaa, xdata;
        if (re.test(value)) {
            adata = value.split("/");
            gg = parseInt(adata[0], 10);
            mm = parseInt(adata[1], 10);
            aaaa = parseInt(adata[2], 10);
            xdata = new Date(Date.UTC(aaaa, mm - 1, gg, 12, 0, 0, 0));
            if (((xdata.getUTCMonth() === mm - 1) && (xdata.getUTCDate() === gg) && xdata.getUTCFullYear() === aaaa)) {
                check = true;
            } else {
                check = false;
            }
        } else {
            check = false;
        }
        return this.optional(element) || check;
    }, $.validator.messages.date);

    // Only letters
    $.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[A-Za-zčćžđšČĆŽŠĐ]+$/g.test(value);
    }, "Letters only");

    // No white space
    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "White space not allowed");

    // Onlly letters and space
    $.validator.addMethod("lettersspace", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\s]*$/i.test(value);
    }, "Letters only");


    // Validate (rules, messages...)
    $("#registrationForm").validate({
      rules: {
        name: {
          required: true,
          lettersonly: true,
          nowhitespace: true,
          minlength: 4,
        },
        lastname: {
          required: true,
          lettersonly: true,
          nowhitespace: true,
          minlength: 4,
        },
        username: {
          required: true,
          nowhitespace: true,
          minlength: 4,
          remote: {
            url: "validateUsername.php",
            type: "post",
            dataType: "json",
            data: {
              username: function () {
                return $("#username").val();
              },
            },
          },
        },
        email: {
          required: true,
          nowhitespace: true,
          email: true,
          remote: {
            url: "validateEmail.php",
            type: "post",
            dataType: "json",
            data: {
              email: function () {
                return $("#email").val();
              },
            },
          },
        },
        password: {
          required: true,
          nowhitespace: true,
          minlength: 6,
        },
        repeatPassword: {
          required: true,
          equalTo: "#password",
        },
        city: {
          required: true,
          lettersspace: true,
          minlength: 4,
        },
        pippo: {
          required: true,
          nowhitespace: true,
          date: true,
        },
        gender: {
          required: true,
        },
      },
      messages: {
        name: {
          required: "This field is required",
          minlength: "Minimum 4 characters",
        },
        lastname: {
          required: "This field is required",
          minlength: "Minimum 4 characters",
        },
        username: {
          required: "This field is required",
          minlength: "Minimum 4 characters",
          remote: "Username already exists",
        },
        email: {
          required: "This field is required",
          email: "Unesite validan email",
          remote: "Email already exists",
        },
        password: {
          required: "This field is required",
          minlength: "Minimum 6 characters",
        },
        repeatPassword: {
          required: "This field is required",
          equalTo: "Password doesn't match",
        },
        city: {
          required: "This field is required",
          minlength: "Minimum 4 characters",
        },
        pippo: {
          required: "This field is required",
          date: "Please enter a valid email",
        },
        gender: {
          required: "This field is required",
        },
      },
      errorPlacement: function (error, element) {
        if (element.is(":radio")) {
          error.appendTo(element.parent(".gender"));
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function (form) {
        form.submit();
      },
    });
})