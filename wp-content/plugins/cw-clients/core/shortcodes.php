<?php
# A set of plugin shortcodes
add_shortcode('cw_clients', array('CwClients', 'showClientsTemplate'));
add_shortcode('cw_clients_form', array('CwClients', 'showFormTemplate'));