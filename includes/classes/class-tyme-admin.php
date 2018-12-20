<?php

/**
 * Tyme Primary Category Admin Display
 *
 * @package tyme-primary-category
 */


namespace Tyme\PrimaryCategory\Admin;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

class Tyme_Admin {

  public function __construct() {

    if( ! is_admin() ) {
      return;
    }

    add_action( 'submitpost_box', array( $this, 'render_admin_view' ), 10 );
  }

  /**
   * Load the JS Templates For Post Edit Screen
   * @return void
   */
  public function render_admin_view() {
    require( TYME_PATH . 'assets/partials/tyme-views.php' );
  }
}

new \Tyme\PrimaryCategory\Admin\Tyme_Admin;
