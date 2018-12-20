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
}
