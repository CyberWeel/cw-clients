<?php # A set of shortcodes for plugin
# TODO: Add some examination for existing shortcodes. shortcode_exists()
add_shortcode('cw_clients', array('CwClients', 'showClientsTemplate'));
add_shortcode('cw_clients_form', array('CwClients', 'showFormTemplate'));