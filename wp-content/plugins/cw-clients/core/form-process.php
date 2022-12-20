<?php # File for processing client form
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

$cwPostID;
$cwLogoID;
$cwFormData = array();
$cwFormDataPost = $_POST;
$cwFormDataPost = $cwFormDataPost['form_fields'];
$cwFormDataFiles = $_FILES;

foreach (explode('&', $cwFormDataPost) as $chunk) {
  $value = explode('=', $chunk);

  if ($value) {
    $cwFormData[urldecode($value[0])] = urldecode($value[1]);
  }
}

# Without that field post will not be uploaded
if (empty($cwFormData['description']) || !isset($cwFormData['description'])) {
  $cwFormData['description'] = 'Empty';
}

$cwFormData = array(
  'post_title' => 'Client\'s Card',
  'post_content' => $cwFormData['description'],
  'post_author' => 1,
  'post_excerpt' => $cwFormData['short'],
  'post_status' => 'draft',
  'comment_status' => 'closed',
  'ping_status' => 'closed',
	'post_type' => 'post',
  'post_category' => array(CW_CLIENTS_ID),
  'meta_input' => array(
    'address' => $cwFormData['address'],
    'phone' => $cwFormData['phone'],
    'email' => $cwFormData['email'],
    'website' => $cwFormData['website'],
    'facebook' => $cwFormData['facebook'],
    'whatsapp' => $cwFormData['whatsapp'],
    'about' => $cwFormData['about']
  )
);

$cwPostID = wp_insert_post($cwFormData);

if (!function_exists('media_handle_sideload')) {
  require_once ABSPATH.'wp-admin/includes/image.php';
  require_once ABSPATH.'wp-admin/includes/file.php';
  require_once ABSPATH.'wp-admin/includes/media.php';
}

if (!empty($cwFormDataFiles['logo'])) {
  $cwLogoID = media_handle_upload('logo', $cwPostID);
  set_post_thumbnail($cwPostID, $cwLogoID);
}

if (!empty($cwFormDataFiles['file1'])) {
  media_handle_upload('file1', $cwPostID);
}

if (!empty($cwFormDataFiles['file2'])) {
  media_handle_upload('file2', $cwPostID);
}

if (!empty($cwFormDataFiles['file3'])) {
  media_handle_upload('file3', $cwPostID);
}

# TODO: Сделать проверки на уровне PHP. Очистки сделаны автоматически функцией ниже. Но можно ебануть каждому полю sanitize_text_field()