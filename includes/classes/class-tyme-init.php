<?php

/**
 * Initializes plugin
 *
 * @package tyme-primary-category
 */


namespace Tyme\PrimaryCategory\Core;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

class Tyme_Init {

  public function __construct() {
    $this->load_dependencies();
    $this->disable_gutenberg();
  }

  /**
   * Disable Gutenberg
   * @return void
   */
  private function disable_gutenberg() {
    add_filter('use_block_editor_for_post', '__return_false', 10);
    add_filter('use_block_editor_for_post_type', '__return_false', 10);
  }

  /**
   * Load plugin dependency files
   * @return void
   */
  private function load_dependencies() {
    require( TYME_INC . '/classes/class-tyme-taxonomies.php' );

    if( is_admin() ) {
      require( TYME_INC . '/classes/class-tyme-assets.php' );
      require( TYME_INC . '/classes/class-tyme-admin.php' );
    }
  }
}
