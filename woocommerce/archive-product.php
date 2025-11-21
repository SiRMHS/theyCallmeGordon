<?php
/**
 * WooCommerce Archive (Shop) template - lightweight wrapper
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

if ( function_exists( 'woocommerce_content' ) ) {
    woocommerce_content();
} else {
    // Fallback: show posts loop
    get_template_part( 'index' );
}

get_footer();
