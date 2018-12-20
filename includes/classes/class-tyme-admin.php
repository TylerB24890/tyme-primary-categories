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
  }
}

new \Tyme\PrimaryCategory\Admin\Tyme_Admin;
