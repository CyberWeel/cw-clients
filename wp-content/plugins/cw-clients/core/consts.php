<?php # Set of constants for plugin
define('CW_CLIENTS', dirname(__DIR__), false);
define('CW_CLIENTS_CLASSES', CW_CLIENTS.'/classes', false);
define('CW_CLIENTS_CORE', CW_CLIENTS.'/core', false);

define('CW_CLIENTS_ID', 2);
define('CW_CLIENTS_LABEL', "Client's Post");
define('CW_CLIENTS_SLUG', 'cw-clients');
define('CW_CLIENTS_TYPE', 'clients-post');

define('CW_CLIENTS_CSS', '/wp-content/plugins/'.CW_CLIENTS_SLUG.'/css', false);
define('CW_CLIENTS_JS', '/wp-content/plugins/'.CW_CLIENTS_SLUG.'/js', false);