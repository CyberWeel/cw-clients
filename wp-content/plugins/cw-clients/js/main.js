jQuery(document).ready(function($) {
  // Event for submitting client form
  $('.cw-clients-form').submit(function(e) {
    e.preventDefault();
    const FORM = $(this);
    const FORM_DATA = FORM.serializeArray();

    $.ajax({
      url: '/wp-content/plugins/cw-clients/core/form-process.php',
      type: 'post',
      data: FORM_DATA,
      dataType: 'html',
      success: function(result) {
        console.log(result);
      },
      error: function(result) {
        console.log(result);
      }
    });
  });
});