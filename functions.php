<?php
// functions.php — enqueue CDN assets, register supports for Elementor & WooCommerce
add_theme_support('elementor');
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
function add_tailwind_cdn() {
    wp_enqueue_script(
        'tailwind-cdn',
        'https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'add_tailwind_cdn');

if ( ! function_exists( 'tcg_setup_theme' ) ) {
    function tcg_setup_theme() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
        add_theme_support( 'woocommerce' );
        add_theme_support( 'align-wide' );
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'theycallmegordon' ),
        ) );
    }
    add_action( 'after_setup_theme', 'tcg_setup_theme' );
}

function tcg_enqueue_assets() {
    // Tailwind via Play CDN (in head)
    wp_enqueue_script( 'tailwind-cdn', 'https://cdn.tailwindcss.com', array(), null, false );

    // Swiper
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), '10' );
    wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), '10', true );

    // GSAP
    wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js', array(), '3.12.2', true );

    // Barba (UMD build)
    wp_enqueue_script( 'barba', 'https://unpkg.com/@barba/core/dist/barba.umd.js', array(), null, true );

    // Theme main stylesheet (style.css exists; Tailwind handles layout)
    wp_enqueue_style( 'tcg-style', get_stylesheet_uri(), array( 'swiper-css' ), wp_get_theme()->get( 'Version' ) );

    // Theme app JS (initializes Swiper/Barba/GSAP hooks)
    wp_enqueue_script( 'tcg-app', get_theme_file_uri( '/assets/js/app.js' ), array( 'swiper', 'gsap', 'barba' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'tcg_enqueue_assets' );

// WooCommerce basic wrappers so templates fit theme markup
function tcg_woocommerce_wrapper_start() {
    echo '<main id="site-content" role="main" class="container mx-auto px-4">';
}
function tcg_woocommerce_wrapper_end() {
    echo '</main>';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'tcg_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'tcg_woocommerce_wrapper_end', 10 );
