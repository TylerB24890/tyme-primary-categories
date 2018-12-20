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
define( 'TYME_VERSION', '1.0.0' );
define( 'TYME_URL', plugin_dir_url( __FILE__ ) );
define( 'TYME_PATH', dirname( __FILE__ ) . '/' );
define( 'TYME_INC', TYME_PATH . 'includes/' );

// Include setup file
require_once( TYME_INC . 'functions/setup.php' );

// Activation/Deactivation
register_activation_hook( __FILE__, '\Tyme\PrimaryCategory\Core\activate' );
register_deactivation_hook( __FILE__, '\Tyme\PrimaryCategory\Core\deactivate' );

// Bootstrap plugin
\Tyme\PrimaryCategory\Core\setup();
