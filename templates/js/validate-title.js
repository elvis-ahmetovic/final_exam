// Validate Title on Coach Panel PAge

$(document).ready(function () {

  // Onlly letters and space
  $.validator.addMethod(
    "lettersspace",
    function (value, element) {
      return this.optional(element) || /^[a-zA-ZčćžđšČĆŽŠĐ\s]*$/i.test(value);
    },
    "Letters only"
  );

  // Validate (rules, messages...)
  $("#changeTitleForm").validate({
    rules: {
      newTitle: {
        required: true,
        lettersspace: true,
        minlength: 4,
      },
    },
    messages: {
      newTitle: {
        required: "Type message title",
        lettersspace: "Numbers and special characters not allowed",
        minlength: "Minimum 4 characters",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
