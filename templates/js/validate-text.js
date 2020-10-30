// Validate Title on Coach Panel PAge

$(document).ready(function () {

  // Validate (rules, messages...)
  $("#changeTexteForm").validate({
    rules: {
      newText: {
        required: true
      },
    },
    messages: {
      newText: {
        required: "Type a message"
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
