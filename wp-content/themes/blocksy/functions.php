<?php
/**
 * Blocksy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blocksy
 */

if (version_compare(PHP_VERSION, '5.7.0', '<')) {
	require get_template_directory() . '/inc/php-fallback.php';
	return;
}

require get_template_directory() . '/inc/init.php';

add_action('wp_enqueue_scripts', 'my_scripts');
function my_scripts() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('my_js', '/wp-content/plugins/cw-clients/js/main.js');
}