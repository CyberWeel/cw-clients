<?php # File for processing client form
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

$cwPostID;
$cwFormDataPost = $_POST;

# Without that field post will not be uploaded
if (empty($cwFormDataPost['description']) || !isset($cwFormDataPost['description'])) $cwFormDataPost['description'] = 'Empty';

$cwFormData = array(
  'post_title' => 'Client\'s Card',
  'post_content' => $cwFormDataPost['description'],
  'post_author' => 1,
  'post_excerpt' => $cwFormDataPost['short'],
  'post_status' => 'draft',
  'comment_status' => 'closed',
  'ping_status' => 'closed',
	'post_type' => 'post',
  'post_category' => array(CW_CLIENTS_ID),
  'meta_input' => array(
    'address' => $cwFormDataPost['address'],
    'phone' => $cwFormDataPost['phone'],
    'email' => $cwFormDataPost['email'],
    'website' => $cwFormDataPost['website'],
    'facebook' => $cwFormDataPost['facebook'],
    'whatsapp' => $cwFormDataPost['whatsapp'],
    'about' => $cwFormDataPost['about']
  )
);

$cwPostID = wp_insert_post($cwFormData);

//if (!function_exists('media_handle_sideload')) {
  //require_once ABSPATH.'wp-admin/includes/image.php';
  //require_once ABSPATH.'wp-admin/includes/file.php';
  //require_once ABSPATH.'wp-admin/includes/media.php';
//}

//media_handle_sideload($file_array, $cwPostID);

//$cwFormData = array(
  //'ID' => $cwPostID,
  //'post_title' => 'Client\'s Card',
  //'post_content' => $cwFormDataPost['description'],
//);

//logo
//file1
//file2
//file3

# TODO: Сделать проверки на уровне PHP. Очистки сделаны автоматически функцией ниже. Но можно ебануть каждому полю sanitize_text_field()