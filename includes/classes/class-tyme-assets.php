<?php

/**
* Loads all plugin assets
*
* @package tyme-primary-category
*/


namespace Tyme\PrimaryCategory\Core;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

class Tyme_Assets {

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
      wp_enqueue_style( 
        'tyme-admin-style', 
        TYMECAT_URL . 'assets/styles/tyme.css', 
        array(), 
        TYMECAT_VERSION 
      );

      // Admin scripts
      wp_enqueue_script( 
        'tyme-admin-script', 
        TYMECAT_URL . "assets/js/tyme.js", 
        array( 'jquery' ), 
        TYMECAT_VERSION, 
        true 
      );

      if( Tyme_Init::is_gutenberg() ) {
        wp_enqueue_script( 
          'tyme-admin-gutenberg-script', 
          TYMECAT_URL . "assets/js/tyme-gutenberg.js", 
          array( 'jquery' ), 
          TYMECAT_VERSION, 
          true );
      }

      // Localized Variables
      wp_localize_script( 'tyme-admin-script', 'tymeVars', $this->localize_admin_scripts() );
      wp_localize_script( 'tyme-admin-gutenberg-script', 'tymeVars', $this->localize_admin_scripts() );
    }
  }

  /**
  * Localize the post taxonomies for JS
  * @return array  Array of primary taxonomies set for the post
  */
  private function localize_admin_scripts() {
    $tax = new Tyme_Taxonomies();

    $localized = array(
      'taxonomies' => $tax->get_primary_term()
    );

    return $localized;
  }
}

new \Tyme\PrimaryCategory\Core\Tyme_Assets();
