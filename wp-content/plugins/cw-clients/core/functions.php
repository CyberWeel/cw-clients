<?php # General actions

# Adding support for miniatures
add_action('after_setup_theme', function() {
  add_theme_support('post-thumbnails', array(CW_CLIENTS_TYPE));
});

# Create new custom post type
add_action('init', function() {
  register_post_type(CW_CLIENTS_TYPE, array(
    'label' => CW_CLIENTS_TYPE,
    'labels' => array(
      'name' => CW_CLIENTS_LABEL.'s',
      'singular_name' => CW_CLIENTS_LABEL,
      'add_new' => 'Add new '.CW_CLIENTS_LABEL,
      'add_new_item' => 'Add new '.CW_CLIENTS_LABEL,
      'edit_item' => 'Edit '.CW_CLIENTS_LABEL,
      'new_item' => 'New '.CW_CLIENTS_LABEL,
      'view_item' => 'View '.CW_CLIENTS_LABEL,
      'search_items' => 'Find '.CW_CLIENTS_LABEL.'s',
      'not_found' => CW_CLIENTS_LABEL.'s not found',
      'not_found_in_trash' => CW_CLIENTS_LABEL.'s not found in Trash',
      'parent_item_colon' => CW_CLIENTS_LABEL.'s parent page',
      'all_items' => CW_CLIENTS_LABEL.'s',
      'archives' => CW_CLIENTS_LABEL.'s',
      'insert_into_item' => 'Insert in '.CW_CLIENTS_LABEL,
      'uploaded_to_this_item' => 'Uploaded to '.CW_CLIENTS_LABEL,
      'featured_image' => CW_CLIENTS_LABEL.' logo',
      'set_featured_image' => 'Set logo for '.CW_CLIENTS_LABEL,
      'remove_featured_image' => 'Delete logo for '.CW_CLIENTS_LABEL,
      'use_featured_image' => 'Use as logo for '.CW_CLIENTS_LABEL,
      'filter_items_list' => 'Filter '.CW_CLIENTS_LABEL.'s',
      'items_list_navigation' => CW_CLIENTS_LABEL.'s navigation',
      'items_list' => CW_CLIENTS_LABEL.'s',
      'menu_name' => CW_CLIENTS_LABEL.'s',
      'name_admin_bar' => CW_CLIENTS_LABEL,
      'view_items' => 'View '.CW_CLIENTS_LABEL.'s',
      'attributes' => CW_CLIENTS_LABEL.' attributes',
      'item_updated' => CW_CLIENTS_LABEL.' updated',
      'item_published' => CW_CLIENTS_LABEL.' published',
      'item_published_privately' => CW_CLIENTS_LABEL.' published privately',
      'item_reverted_to_draft' => CW_CLIENTS_LABEL.' reverted to draft',
      'item_scheduled' => CW_CLIENTS_LABEL.' scheduled'
    ),
    'description' => CW_CLIENTS_LABEL.'s special for plugin',
    'public' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'menu_position' => 4,
    'menu_icon' => 'dashicons-admin-users',
    'capability_type' => 'post',
    'map_meta_cap' => 'true',
    'hierarchical' => false,
    'supports' => array(
      'title', 'editor', 'thumbnail', 'excerpt'
    ), # TODO: custom-fields. https://wp-kama.ru/function/register_post_type#supports
    # register_meta_box_cb. https://wp-kama.ru/function/register_post_type#register_meta_box_cb
    'taxonomies' => array('category'), # Не уверен, что корректно установил
    'has_archive' => false,
    'rewrite' => array(
      'slug' => CW_CLIENTS_TYPE,
      'with_front' => false
    ),
    'can_export' => true,
    'delete_with_user' => false,
    # template. https://wp-kama.ru/function/register_post_type#template
    # template_lock. https://wp-kama.ru/function/register_post_type#template_lock
  ));
});

# Add CSS and JS files for plugin
add_action('wp_enqueue_scripts', function() {
  wp_enqueue_style('cwMainCSS', CW_CLIENTS_CSS.'/main.css');

  wp_enqueue_script('jquery');
  wp_enqueue_script('cwMainJS', CW_CLIENTS_JS.'/main.js');
});