// Validate Fields on New Message Page

$(document).ready(function () {
  // Validate (rules, messages...)
  $("#newMsgForm").validate({
    rules: {
      msg_to: {
        required: true,
      },
      newText: {
        required: true,
      },
    },
    messages: {
      msg_to: {
        required: "Choose a coach"
      },
      newText: {
        required: "Type a message"
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
