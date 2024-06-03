<?php
/**
 * Plugin Name:     Goonj Custom
 * Plugin URI:      https://github.com/coloredcow/civicrm/
 * Description:     Customizations done for Goonj.
 * Author:          ColoredCow
 * Author URI:      https://coloredcow.com
 * Text Domain:     goonj-custom
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Goonj_Custom
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'GC_PLUGIN_FILE' ) ) {
	define( 'GC_PLUGIN_FILE', __FILE__ );
}

add_action( 'wp_enqueue_scripts', 'gc_register_scripts' );
function gc_register_scripts() {
	wp_register_script(
		'gc-source-tracking',
		plugins_url( 'assets/js/source-tracking.js', GC_PLUGIN_FILE ),
		array ('jquery' ),
		'0.1.0',
		false
	);
}

add_action( 'wp_enqueue_scripts', 'gc_enqueue_scripts' );
function gc_enqueue_scripts() {
	wp_enqueue_script( 'gc-source-tracking' );
}
