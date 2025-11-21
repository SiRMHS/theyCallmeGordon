<?php
/**
 * WooCommerce compatibility helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Remove WooCommerce default styles to let theme/Elementor control styling (optional)
if ( ! function_exists( 'nemove_woocommerce_disable_styles' ) ) {
    function nemove_woocommerce_disable_styles( $enqueue_styles ) {
        // return empty array to prevent core styles loading
        // return array();
        return $enqueue_styles;
    }
    add_filter( 'woocommerce_enqueue_styles', 'nemove_woocommerce_disable_styles' );
}

// Theme wrappers: open/close container for better layout control
function nemove_woocommerce_wrapper_start() {
    echo '<main class="site-main woocommerce">\n<div class="wrap">';
}
function nemove_woocommerce_wrapper_end() {
    echo '</div><!-- .wrap -->\n</main>';
}
add_action( 'woocommerce_before_main_content', 'nemove_woocommerce_wrapper_start', 5 );
add_action( 'woocommerce_after_main_content', 'nemove_woocommerce_wrapper_end', 5 );

// Make sure theme declares support for product gallery features (already set in setup but keep here as safe check)
add_action( 'after_setup_theme', function() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
} );

?>