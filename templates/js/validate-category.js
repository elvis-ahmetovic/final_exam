// Validate Category on Coach Panel PAge

$(document).ready(function () {

  // Validate (rules, messages...)
  $("#changeCategoryForm").validate({
    rules: {
      newCategory: {
        required: true,
      },
    },
    messages: {
      newCategory: {
        required: "Choose category",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
  });
});
