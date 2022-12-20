jQuery(document).ready(function($) {
  // Event for submitting client form
  $('.cw-clients-form').submit(function(e) {
    e.preventDefault();
    const FORM = $(this);
    const FORM_FIELDS = FORM.serialize();
    const FORM_DATA = new FormData();
    const LOGO = FORM.find('[name="logo"]').prop('files')[0];
    const FILE1 = FORM.find('[name="file1"]').prop('files')[0];
    const FILE2 = FORM.find('[name="file2"]').prop('files')[0];
    const FILE3 = FORM.find('[name="file3"]').prop('files')[0];

    FORM_DATA.append('form_fields', FORM_FIELDS);
    FORM_DATA.append('logo', LOGO);
    FORM_DATA.append('file1', FILE1);
    FORM_DATA.append('file2', FILE2);
    FORM_DATA.append('file3', FILE3);

    $.ajax({
      url: '/wp-content/plugins/cw-clients/core/form-process.php',
      type: 'post',
      data: FORM_DATA,
      dataType: 'text',
      cache: false,
      contentType: false,
      processData: false,
      success: function(result) {
        console.log(result);
      },
      error: function(result) {
        console.log(result);
      }
    });
  });
});
// TODO: Добавить очистки на уровне JS