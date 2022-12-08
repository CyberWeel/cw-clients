<?php
# Adding menu for admin page
add_action('admin_menu', function() {
  add_menu_page(
    'Clients',
    'Clients',
    'manage_options',
    CW_CLIENTS_PLUGIN_NAME,
    array('CwClients', 'showAdminPage'),
    'dashicons-admin-users',
    4
  );
});

# Hide all client forms from posts
add_action('pre_get_posts', function($query) {
  global $pagenow;

  if (is_admin() && $pagenow === 'edit.php' && get_query_var('post_type') === 'post') {
		$query->set('category__not_in', array(CW_CLIENTS_PLUGIN_ID));
	}

  return $query;
});