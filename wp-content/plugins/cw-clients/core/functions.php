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