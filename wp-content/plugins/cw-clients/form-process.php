<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

$cwFormData = $_POST;

$cwFormDataPost = array(
  'comment_status' => 'closed',
  'ping_status' => 'closed',
  'post_author' => 1,
  'post_content' => 'Sample Text',
  'post_excerpt' => 'smpl txt',
  'post_status' => 'draft',
  'post_title' => 'Sample Text',
	'post_type' => 'post',
  'post_category' => array(3),
  'meta_input' => array(
    'phone' => $cwFormData['phone'],
    'country' => $cwFormData['country'],
    'description' => $cwFormData['description']
  )
);

wp_insert_post(wp_slash($cwFormDataPost));