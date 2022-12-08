<?php
/**
* Plugin Name: CW Clients
* Description: Plugin for showing client's forms filled by themselves. Special for Noblie
* Version: 1.0
* Author: CyberWeel
* Author URI: https://github.com/CyberWeel/my-wp-plugin
*/

# Activating core plugin files
require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/cw-clients/core/constants.php';
require_once CW_CLIENTS_CLASSES.'/CwClients.php';
require_once CW_CLIENTS_CORE.'/shortcodes.php';
require_once CW_CLIENTS_ADMIN.'/functions.php';