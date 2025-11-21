<?php
/**
 * Single product template fallback to WooCommerce content
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

if ( function_exists( 'woocommerce_content' ) ) {
    woocommerce_content();
} else {
    // Fallback: single post template
    get_template_part( 'template-parts/content', 'single' );
}

get_footer();
