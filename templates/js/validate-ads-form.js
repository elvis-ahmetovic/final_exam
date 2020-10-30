// Become A Coach form validation

$(document).ready(function () {

  // No white space
    $.validator.addMethod("nowhitespace", function (value, element) {
        return this.optional(element) || /^\S+$/i.test(value);
    }, "White space not allowed");

  // Onlly letters and space
  $.validator.addMethod(
    "lettersspace",
    function (value, element) {
      return this.optional(element) || /^[a-zA-ZčćžđšČĆŽŠĐ\s]*$/i.test(value);
    },
    "Letters only"
  );

  // Validate (rules, messages...)
  $("#advertise-form").validate({
    rules: {
      category: {
        required: true,
      },
      price: {
        required: true,
      },
      phone: {
        required: true,
        nowhitespace: true,
        number: true,
        minlength: 9,
        maxlength: 10,
      },
      titleMsg: {
        required: true,
        lettersspace: true,
        minlength: 4,
      },
      textMsg: {
        required: true,
      },
    },
    messages: {
      category: {
        required: "Choose a category",
      },
      price: {
        required: "Set price",
      },
      phone: {
        required: "Enter your phone number",
        number: "Letters and special characters not allowed",
        minlength: "Minimum 9 numbers",
        maxlength: "Maximum 10 numbers",
      },
      titleMsg: {
        required: "Type your message title",
        lettersspace: "Numbers and special characters not allowed",
        minlength: "Minimum 4 characters",
      },
      textMsg: {
        required: "Type a message",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
