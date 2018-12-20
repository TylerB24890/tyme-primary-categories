<?php

/**
* Tyme Primary Category Core Functionality
*
* Includes getter/setter functions for primary taxonomies
*
* @package tyme-primary-category
*/


namespace Tyme\PrimaryCategory\Core;

if ( ! defined( 'ABSPATH' ) ) exit(); // No direct access

class Tyme_Taxonomies {

  /**
  * Tyme Primary Category Meta Prefix
  * @var string
  */
  private $meta_prefix;

  public function __construct() {
    $this->meta_prefix = '_tyme_primary_';

    add_filter( 'post_link_category', array( $this, 'adjust_post_link' ), 10, 3 );
  }

  /**
  * Get primary taxonomy for a given post
  * @param  int||object   Post ID or Post Object to retrieve primary tax
  * @return array         Array of available taxonomies & primary tax
  */
  public function get_primary_tax( $post = null ) {

    $post = $this->get_post_object( $post );

    $taxonomies = array();

    if ( ! empty( $post ) ) {

      $post_taxonomies = get_object_taxonomies( $post->post_type, 'objects' );

      if( is_array( $post_taxonomies ) && ! empty( $post_taxonomies ) ) {
        foreach( $post_taxonomies as $tax ) {

          $taxonomies[] = array(
            'taxonomy' => $tax->name,
            'primary' => get_post_meta( $post->ID, $this->meta_prefix . $tax->name, true )
          );
        }
      }
    }

    return $taxonomies;
  }

  /**
  * Set the primary taxonomy for a post
  * @param int $post_id    Post ID
  * @param object $post    WP Post Object
  * @return void
  */
  public function set_primary_tax( $post_id, $post ) {

    $taxonomies = $this->get_primary_tax( $post );

    if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
      foreach ( $taxonomies as $taxonomy ) {

        $input_name = ltrim( $this->meta_prefix, '_' ) . $taxonomy['taxonomy'];
        $primary = filter_input( INPUT_POST, $input_name, FILTER_SANITIZE_NUMBER_INT );

        if ( has_term( $primary, $taxonomy['taxonomy'], $post ) && $primary ) {
          if( $taxonomy['primary'] !== $primary ) {
            update_post_meta( $post_id, $this->meta_prefix . $taxonomy['taxonomy'], $primary );
          }
        } else {
          delete_post_meta( $post_id, $this->meta_prefix . $taxonomy['taxonomy'], $taxonomy['primary'] );
        }
      }
    }
  }

  /**
   * Change the post link to include the selected primary category
   * @param  object $category   WordPress Category Object
   * @param  array $categories  Array of categories associated with the post
   * @param  object $post       WP Post Object
   * @return object             New WordPress Category Object of Primary Term
   */
  public function adjust_post_link( $category, $categories = null, $post = null ) {
    $post = $this->get_post_object( $post );

    $post_taxonomies = $this->get_primary_tax( $post );

    $primary = 0;

    if( is_array( $post_taxonomies ) && ! empty( $post_taxonomies ) ) {
      foreach( $post_taxonomies as $taxonomies ) {
        if( $taxonomies['taxonomy'] === 'category' && ! empty( $taxonomies['primary'] ) ) {
          $primary = $taxonomies['primary'];
        }
      }

      if( $primary !== 0 ) {
        $category = get_category( $primary );
      }
    }

    return $category;
  }

  /**
   * Return the WP Post Object
   * @param  int||object  $post The ID or Object of a WP post
   * @return object       The WP Post object
   */
  private function get_post_object( $post ) {
    if( ! $post || $post === null ) {
      global $post;
    }

    if ( ! is_a( $post, 'WP_Post' ) ) {
      $post = get_post( $post );
    }

    return $post;
  }

}

new Tyme_Taxonomies;
