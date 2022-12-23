<?php # Some general actions which could be place on theme's functions.php file

# Adding menu item for admin page
add_action('admin_menu', function() {
  add_menu_page(
    'Clients - a plugin for manage client\'s forms.',
    'Clients',
    'manage_options',
    CW_CLIENTS_NAME,
    array('CwClients', 'showAdminPage'),
    'dashicons-admin-users',
    4
  );
});

# Hide all client forms from posts on admin page
add_action('pre_get_posts', function($query) {
  global $pagenow;

  if (is_admin() && $pagenow === 'edit.php' && get_query_var('post_type') === 'post') {
    $query->set('category__not_in', array(CW_CLIENTS_ID));
  }

  return $query;
});

# Add some CSS and JS files for plugin
add_action('wp_enqueue_scripts', function() {
  wp_enqueue_style('cwMainCSS', CW_CLIENTS_CSS.'/main.css');

  wp_enqueue_script('jquery'); # TODO: Try to delete this on website
  wp_enqueue_script('cwMainJS', CW_CLIENTS_JS.'/main.js');
});

add_action('init', function() {
  register_post_type(CW_CLIENTS_POST_TYPE, array(
    'label' => CW_CLIENTS_POST_TYPE,
    'labels' => array(
      'name' => CW_CLIENTS_LABEL.'\'s',
      'singular_name' => CW_CLIENTS_LABEL,
      'add_new' => 'Add new '.CW_CLIENTS_LABEL,
      'add_new_item' => 'Add new '.CW_CLIENTS_LABEL,
      'edit_item' => 'Edit '.CW_CLIENTS_LABEL,
      'new_item' => 'New '.CW_CLIENTS_LABEL,
      'view_item' => 'View '.CW_CLIENTS_LABEL,
      'search_items' => 'Find '.CW_CLIENTS_LABEL.'\'s',
      'not_found' => CW_CLIENTS_LABEL.'\'s not found',
      'not_found_in_trash' => CW_CLIENTS_LABEL.'\'s not found in Trash',
      'parent_item_colon' => CW_CLIENTS_LABEL.'\'s parent page',
      'all_items' => CW_CLIENTS_LABEL.'\'s',
      'archives' => CW_CLIENTS_LABEL.'\'s',
      'insert_into_item' => 'Insert in '.CW_CLIENTS_LABEL,
      'uploaded_to_this_item' => 'Uploaded to '.CW_CLIENTS_LABEL,
      'featured_image' => CW_CLIENTS_LABEL.' logo',
      'set_featured_image' => 'Set logo for '.CW_CLIENTS_LABEL,
      'remove_featured_image' => 'Delete logo for '.CW_CLIENTS_LABEL,
      'use_featured_image' => 'Use as logo for '.CW_CLIENTS_LABEL,
      'filter_items_list' => 'Filter '.CW_CLIENTS_LABEL.'\'s',
      'items_list_navigation' => CW_CLIENTS_LABEL.'\'s navigation',
      'items_list' => CW_CLIENTS_LABEL.'\'s',
      'menu_name' => CW_CLIENTS_LABEL.'\'s',
      'name_admin_bar' => CW_CLIENTS_LABEL,
      'view_items' => 'View '.CW_CLIENTS_LABEL.'\'s',
      'attributes' => CW_CLIENTS_LABEL.' attributes',
      'item_updated' => CW_CLIENTS_LABEL.' updated',
      'item_published' => CW_CLIENTS_LABEL.' published',
      'item_published_privately' => CW_CLIENTS_LABEL.' published privately',
      'item_reverted_to_draft' => CW_CLIENTS_LABEL.' reverted to draft',
      'item_scheduled' => CW_CLIENTS_LABEL.' scheduled'
    ),
    'description' => 'Clients posts special for plugin',
    'public' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'rest_base' => CW_CLIENTS_POST_TYPE,
    'menu_position' => 4,
    'menu_icon' => 'dashicons-admin-users',
    'capability_type' => 'post',
    'map_meta_cap' => 'true',
    'hierarchical' => false,
    'supports' => array(
      'title', 'editor', 'thumbnail', 'excerpt', '', '', '', '', '', ''
    ), # TODO: custom-fields
    # register_meta_box_cb
    'taxonomies' => array('category'),
    'has_archive' => false,
    'rewrite' => array(
      'slug' => CW_CLIENTS_POST_TYPE,
      'with_front' => false
    )
  ));
});


//Важно: после создания нового типа записи. Обязательно нужно зайти на страницу Настройки → Постоянные ссылки. Нужно это для того, чтобы правила ЧПУ были пересозданы и туда были добавлены правила нового типа записи.