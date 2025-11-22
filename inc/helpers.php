<?php
// helpers.php — محل قرارگیری توابع کمکی قالب

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// نمونه تابع: چاپ آدرس theme assets
function tcg_asset( $path ) {
    return get_theme_file_uri( '/assets/' . ltrim( $path, '/' ) );
}
