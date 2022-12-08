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