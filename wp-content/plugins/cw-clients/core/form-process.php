<?php # File for processing client form
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

if (!function_exists('media_handle_sideload')) {
  require_once ABSPATH.'wp-admin/includes/image.php';
  require_once ABSPATH.'wp-admin/includes/file.php';
  require_once ABSPATH.'wp-admin/includes/media.php';
}

$cwPostID;
$cwLogoID;
$cwFormData = array();
$cwFormDataPost = $_POST;
$cwFormDataPost = $cwFormDataPost['form_fields'];
$cwFormDataPost = explode('&', $cwFormDataPost);
$cwImagesTypesAllowed = array('image/jpg', 'image/jpeg', 'image/png');

foreach ($cwFormDataPost as $item) {
  $item = explode('=', $item);
  $item_key = $item[0];
  $item_key = sanitize_key(sanitize_text_field($item_key));
  $item_value = urldecode($item[1]);

  switch ($item_key) {
    case 'description':
      $item_value = sanitize_textarea_field($item_value);
      if (empty($item_value)) $item_value = 'Empty'; # Without that field post will not be uploaded
      if (mb_strlen($item_value) > 500) $item_value = mb_substr($item_value, 0, 500);
      break;

    default:
      $item_value = sanitize_text_field($item_value);
      break;
  }

  $cwFormData[$item_key] = $item_value;
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

if (!empty($_FILES['logo']) && in_array($_FILES['logo']['type'], $cwImagesTypesAllowed)) {
  $cwLogoID = media_handle_upload('logo', $cwPostID);
  set_post_thumbnail($cwPostID, $cwLogoID);
}

if (!empty($_FILES['file1']) && in_array($_FILES['file1']['type'], $cwImagesTypesAllowed)) {
  media_handle_upload('file1', $cwPostID);
}

if (!empty($_FILES['file2']) && in_array($_FILES['file2']['type'], $cwImagesTypesAllowed)) {
  media_handle_upload('file2', $cwPostID);
}

if (!empty($_FILES['file3']) && in_array($_FILES['file3']['type'], $cwImagesTypesAllowed)) {
  media_handle_upload('file3', $cwPostID);
}