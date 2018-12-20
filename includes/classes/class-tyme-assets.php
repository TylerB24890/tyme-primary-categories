<?php

/**
 * Loads all plugin assets
 *
 * @package tyme-primary-category
 */


namespace Tyme\PrimaryCategory\Core;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

class Assets {

  public function __construct() {
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ), 10, 1 );
  }

  /**
   * Check that we are on the post edit page and enqueue assets accordingly
   * @param  string $hook The page we are on in wp-admin
   * @return void
   */
  public function admin_assets( $hook ) {
    if ( 'post.php' == $hook ) {
      // Admin styles
      wp_enqueue_style( 'tyme-admin-style', TYME_URL . 'assets/styles/tyme.css', array(), TYME_VERSION );

      // Admin scripts
      wp_enqueue_script( 'tyme-admin-script', TYME_URL . "assets/js/tyme.js", array( 'jquery' ), TYME_VERSION, true );
    }
  }
}

new \Tyme\PrimaryCategory\Core\Assets();
