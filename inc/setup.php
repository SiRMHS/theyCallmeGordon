<?php
/**
 * Theme setup: supports, menus, image sizes
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nemove_theme_setup() {
    // Basic supports
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    // WooCommerce support
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Register menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'nemove' ),
        'footer'  => __( 'Footer Menu', 'nemove' ),
    ) );
}
add_action( 'after_setup_theme', 'nemove_theme_setup' );

// Small helper for image sizes (adjust as needed)
add_action( 'after_setup_theme', function() {
    add_image_size( 'nemove-thumb', 600, 400, true );
} );

// Simple helper to read theme options set in nemove_options
if ( ! function_exists( 'nemove_get_option' ) ) {
    /**
     * Get theme option with optional override support.
     * Use the global $nemove_option_overrides to provide run-time overrides (used by widget overrides).
     */
    function nemove_get_option( $key, $default = '' ) {
        // Check global overrides first
        if ( isset( $GLOBALS['nemove_option_overrides'] ) && is_array( $GLOBALS['nemove_option_overrides'] ) ) {
            $overrides = $GLOBALS['nemove_option_overrides'];
            if ( isset( $overrides[ $key ] ) ) {
                return $overrides[ $key ];
            }
        }
        $opts = get_option( 'nemove_options', array() );
        if ( isset( $opts[ $key ] ) ) {
            return $opts[ $key ];
        }
        return $default;
    }
}
    // Simple svg helper for small star used in festival header
    if ( ! function_exists( 'nemove_star_svg' ) ) {
        function nemove_star_svg() {
            return '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.89996 1.5L6.76705 3.75443C6.90806 4.12105 6.97856 4.30435 7.0882 4.45854C7.18537 4.5952 7.30476 4.7146 7.44142 4.81177C7.59561 4.9214 7.77892 4.99191 8.14553 5.13291L10.4 6L8.14553 6.86709C7.77892 7.00809 7.59561 7.0786 7.44142 7.18824C7.30477 7.28541 7.18537 7.4048 7.0882 7.54146C6.97856 7.69565 6.90806 7.87895 6.76705 8.24557L5.89996 10.5L5.03288 8.24557C4.89187 7.87895 4.82137 7.69565 4.71173 7.54146C4.61456 7.4048 4.49516 7.28541 4.35851 7.18824C4.20432 7.0786 4.02101 7.00809 3.65439 6.86709L1.39996 6L3.65439 5.13291C4.02101 4.99191 4.20432 4.9214 4.35851 4.81177C4.49516 4.7146 4.61456 4.5952 4.71173 4.45854C4.82137 4.30435 4.89187 4.12105 5.03287 3.75443L5.89996 1.5Z" fill="#D09295" stroke="#D09295" stroke-width="0.9" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        }
    }

    // Convert western digits to Persian digits (۰۱۲۳۴۵۶۷۸۹). Only converts digits, keeps letters intact.
    if ( ! function_exists( 'nemove_to_persian_digits' ) ) {
        function nemove_to_persian_digits( $input ) {
            $western = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
            $persian = array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' );
            return str_replace( $western, $persian, $input );
        }
    }
?>