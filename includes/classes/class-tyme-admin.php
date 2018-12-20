<?php

/**
* Tyme Primary Category Admin Display
*
* @package tyme-primary-category
*/


namespace Tyme\PrimaryCategory\Admin;

use \Tyme\PrimaryCategory\Core\Tyme_Taxonomies as Taxonomies;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

class Tyme_Admin {

  public function __construct() {

    if( ! is_admin() ) {
      return;
    }

    add_action( 'submitpost_box', array( $this, 'render_admin_view' ), 10 );
    add_action( 'save_post', array( $this, 'save_primary_tax' ), 10, 2 );
  }

  /**
  * Load the JS Templates For Post Edit Screen
  * @return void
  */
  public function render_admin_view() {
    require( TYME_PATH . 'assets/partials/tyme-views.php' );
  }

  /**
  * Save the selected primary taxonomy to the post
  * @param  int $post_id    Post ID
  * @param  object $post    WP Post Object
  * @return void
  */
  public function save_primary_tax( $post_id, $post ) {
    $nonce = $_POST['tyme_primary_nonce'];

    if ( wp_verify_nonce( $nonce, 'tyme_primary_nonce' ) ) {
      $tax_obj = new Taxonomies();
      $tax_obj->set_primary_tax( $post_id, $post );
    }
  }
}

new \Tyme\PrimaryCategory\Admin\Tyme_Admin;
