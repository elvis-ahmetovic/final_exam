// Validate Phone on Coach Panel Page

$(document).ready(function () {
  // No white space
  $.validator.addMethod(
    "nowhitespace",
    function (value, element) {
      return this.optional(element) || /^\S+$/i.test(value);
    },
    "White space not allowed"
  );

  // Validate (rules, messages...)
  $("#changeTelForm").validate({
    rules: {
      newPhone: {
        required: true,
        nowhitespace: true,
        number: true,
        minlength: 9,
        maxlength: 10,
      },
    },
    messages: {
      newPhone: {
        required: "Please enter your phone number",
        number: "Letters and special characters not allowed",
        minlength: "Minimum 9 numbers",
        maxlength: "Maksimum 10 numbers",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
