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
  }

  /**
   * Check if WP is using the Gutenberg editor
   * @return boolean
   */
  public static function is_gutenberg() {
    global $wp_version;

    if( version_compare( $wp_version, '5.0', '>=' ) ) {
      return true;
    }

    return false;
  }

  /**
   * Disable gutenberg (temporary?)
   */
  private function conditional_filters() {
    if( self::is_gutenberg() ) {
      add_filter('use_block_editor_for_post', '__return_false', 10);
      add_filter('use_block_editor_for_post_type', '__return_false', 10);
    }
  }

  /**
  * Load plugin dependency files
  * @return void
  */
  private function load_dependencies() {
    require( TYMECAT_INC . '/classes/class-tyme-taxonomies.php' );

    if( is_admin() ) {
      require( TYMECAT_INC . '/classes/class-tyme-assets.php' );
      require( TYMECAT_INC . '/classes/class-tyme-admin.php' );
    }
  }
}
