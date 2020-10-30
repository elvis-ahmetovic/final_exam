// Validate Price on Coach Panel Page

$(document).ready(function () {

  // Validate (rules, messages...)
  $("#changePriceForm").validate({
    rules: {
      newPrice: {
        required: true,
        nowhitespace: true,
        number: true,
      },
    },
    messages: {
      newPrice: {
        required: "Please type a price",
        number: "Letters and special characters not allowed",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
