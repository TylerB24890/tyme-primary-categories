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
  }

  /**
   * Get primary taxonomy for a given post
   * @param  int||object   Post ID or Post Object to retrieve primary tax
   * @return array         Array of available taxonomies & primary tax
   */
  public function get_primary_tax( $post = null ) {

    if( ! $post || $post === null ) {
      global $post;
    }

  	if ( ! is_a( $post, 'WP_Post' ) ) {
  		$post = get_post( $post );
  	}

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
  
}
