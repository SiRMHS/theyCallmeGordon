<?php
/**
 * Pharmacy Store - functions.php
 * Load modular theme code from /inc
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Theme constants
if ( ! defined( 'PHARMACY_STORE_VERSION' ) ) {
    define( 'PHARMACY_STORE_VERSION', '1.0.0' );
}

// Require modular files
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/security.php';
// Compatibility includes
require_once get_template_directory() . '/inc/elementor.php';
require_once get_template_directory() . '/inc/woocommerce.php';
// Theme settings admin page
require_once get_template_directory() . '/inc/admin-settings.php';



?>