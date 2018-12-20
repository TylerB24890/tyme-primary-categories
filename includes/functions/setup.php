<?php
/**
 * Plugin initialization and setup
 *
 * @package tyme-primary-category
 */

namespace Tyme\PrimaryCategory\Core;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

/**
 * Default setup routine
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'init' ) );
	add_action( 'plugins_loaded', $n( 'i18n' ) );
}

/**
 * Initializes the plugin
 * @return void
 */
function init() {
	require TYME_INC . 'classes/class-tyme-init.php';
	new Tyme_Init;
}

/**
 * Activate the plugin
 * @return void
 */
function activate() {
	return;
}

/**
 * Deactivate the plugin
 * Uninstall routines should be in uninstall.php
 * @return void
 */
function deactivate() {
  return;
}

/**
 * Registers the default textdomain.
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'tyme' );
	load_textdomain( 'tyme', WP_LANG_DIR . '/tyme/tyme-' . $locale . '.mo' );
	load_plugin_textdomain( 'tyme', false, plugin_basename( TYME_PATH ) . '/languages/' );
}
