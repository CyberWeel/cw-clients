<?php # Some general actions which could be place on theme's functions.php file

# Adding menu item for admin page
add_action('admin_menu', function() {
  add_menu_page(
    'Clients',
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

# Add some JS files for plugin
add_action('wp_enqueue_scripts', 'cwJSScripts');
function cwJSScripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('my_js', '/wp-content/plugins/'.CW_CLIENTS_NAME.'/js/main.js');
}