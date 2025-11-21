<?php
/**
 * Elementor compatibility helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Ensure theme declares support for editor styles and wide align so Elementor works smoothly
add_action( 'after_setup_theme', function() {
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'custom-logo' );
    // Let Elementor know theme supports title tag and post thumbnails (already added in setup)
} );

