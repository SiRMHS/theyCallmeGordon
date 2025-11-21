<?php
/**
 * Enqueue scripts and styles
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function nemove_enqueue_assets() {
    // Styles: prefer compiled Tailwind output if present, fallback to stylesheet
    $compiled_tailwind = get_template_directory_uri() . '/assets/css/style.css';
    if ( file_exists( get_template_directory() . '/assets/css/style.css' ) ) {
        wp_enqueue_style( 'nemove-style', $compiled_tailwind, array(), nemove_VERSION );
    } else {
        // fallback to main stylesheet so theme still loads when Tailwind not built
        wp_enqueue_style( 'nemove-style', get_stylesheet_uri(), array(), nemove_VERSION );
    }

    // Minimal theme script (optional)
    wp_enqueue_script( 'nemove-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), nemove_VERSION, true );

    // Localize script with nonce for AJAX if needed
    wp_localize_script( 'nemove-main', 'pharmacyStore', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'nemove_nonce' ),
    ) );

    // If compiled Tailwind CSS is not present, enqueue the Tailwind browser CDN as a fallback
    if ( ! file_exists( get_template_directory() . '/assets/css/style.css' ) ) {
        wp_enqueue_script( 'nemove-tailwind-browser', 'https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4', array(), null, true );
        // Mark as module (matches <script type="module"> usage)
        if ( function_exists( 'wp_script_add_data' ) ) {
            wp_script_add_data( 'nemove-tailwind-browser', 'type', 'module' );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'nemove_enqueue_assets' );

// Admin styles for editor/Elementor compatibility
function nemove_admin_styles() {
    wp_enqueue_style( 'nemove-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), nemove_VERSION );
}
add_action( 'admin_enqueue_scripts', 'nemove_admin_styles' );

?>

