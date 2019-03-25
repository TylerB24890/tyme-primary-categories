<?php
/**
 * Plugin Name: Tyme Primary Categories
 * Plugin URI:  https://tylerb.me
 * Description: Easily set primary taxonomies for posts
 * Version:     1.0.0
 * Author:      Tyler Bailey
 * Author URI:  https://www.tylerb.me
 * Text Domain: tyme
 * Domain Path: /languages
 * License:     GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
 die( "Sneaky sneaky..." );
}

// Useful global constants
define( 'TYMECAT_VERSION', '1.0.0' );
define( 'TYMECAT_URL', plugin_dir_url( __FILE__ ) );
define( 'TYMECAT_PATH', dirname( __FILE__ ) . '/' );
define( 'TYMECAT_INC', TYMECAT_PATH . 'includes/' );

// Include setup file
require_once( TYMECAT_INC . 'functions/setup.php' );

// Activation/Deactivation
register_activation_hook( __FILE__, '\Tyme\PrimaryCategory\Core\activate' );
register_deactivation_hook( __FILE__, '\Tyme\PrimaryCategory\Core\deactivate' );

// Bootstrap plugin
\Tyme\PrimaryCategory\Core\setup();
