<?php
/**
 * Basic security hardening helpers for the theme
 * Note: Most security should be handled at site/server level and via plugins. Keep theme-level hardening minimal and reversible.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Remove WordPress version from head and generator meta
remove_action( 'wp_head', 'wp_generator' );

// Disable file editing from WP admin
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
    define( 'DISALLOW_FILE_EDIT', true );
}

// Disable PHP error display on front-end (should be set in wp-config / php.ini)
@ini_set( 'display_errors', 0 );

// Remove REST API link tag from head (careful: may break integrations)
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11 );

// Limit allowed file types for upload filter example (optional)
function nemove_restrict_mime_types( $mimes ) {
    // Keep core types but remove risky ones (e.g., exe)
    unset( $mimes['exe'] );
    return $mimes;
}
add_filter( 'upload_mimes', 'nemove_restrict_mime_types' );

?>