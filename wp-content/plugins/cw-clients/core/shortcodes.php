<?php # A set of shortcodes for plugin
add_shortcode('cw_clients', array('CwClients', 'showClientsTemplate'));
add_shortcode('cw_clients_form', array('CwClients', 'showFormTemplate'));