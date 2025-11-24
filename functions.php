<?php
// functions.php — enqueue CDN assets, register supports for Elementor & WooCommerce

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
// ===============================
// Vertical Swiper Shortcode
// ===============================
function vertical_swiper_shortcode() {
    wp_enqueue_style('my-swiper-style', get_stylesheet_directory_uri() . '/assets/css/swiper-style1.css', array(), null);
    wp_enqueue_script('my-swiper-init', get_stylesheet_directory_uri() . '/assets/js/swiper1.js', array('swiper'), null, true);

    ob_start(); ?>
    <div class="my-swiper-container">
        <div class="nav-controls">
            <div class="nav-title">مزایای طراحی رابط کاربری و تجربه کاربری حرفه ای</div>
            <div class="btns-wrapper">
                <div class="btn-circle swiper-button-prev">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 15l6-6 6 6"></path>
                    </svg>
                </div>
                <div class="btn-circle swiper-button-next">
                    <svg fill="none" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-content">
                        <div class="slide-header">
                            <svg viewBox="0 0 24 24"> <use xlink:href="/assets/svg/Capa_1.svg"></use></svg>
                            <span>افزایش رضایت کاربران</span>
                        </div>
                        <div class="slide-caption"><p>افزایش رضایت کاربران، کلید موفقیت در دنیای دیجیتال است. با ایجاد تجربه کاربری مناسب و ارائه محتوای مرتبط، می‌توانیم وفاداری مشتریان را جلب کرده و از طریق نظرات مثبت، مشتریان جدیدی جذب کنیم.</p></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-content">
                        <div class="slide-header">
                            <svg viewBox="0 0 24 24"> <use xlink:href="/assets/svg/Capa_1.svg"></use></svg>
                            <span>افزایش اعتبار محصول</span>
                        </div>
                            <div class="slide-caption"><p>افزایش رضایت کاربران، کلید موفقیت در دنیای دیجیتال است. با ایجاد تجربه کاربری مناسب و ارائه محتوای مرتبط، می‌توانیم وفاداری مشتریان را جلب کرده و از طریق نظرات مثبت، مشتریان جدیدی جذب کنیم.</p></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-content">
                        <div class="slide-header">
                            <svg viewBox="0 0 24 24"> <use xlink:href="/assets/svg/Capa_1.svg"></use></svg>
                            <span>کاهش نرخ ریزش</span>
                        </div>
                    <div class="slide-caption"><p>افزایش رضایت کاربران، کلید موفقیت در دنیای دیجیتال است. با ایجاد تجربه کاربری مناسب و ارائه محتوای مرتبط، می‌توانیم وفاداری مشتریان را جلب کرده و از طریق نظرات مثبت، مشتریان جدیدی جذب کنیم.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('vertical_swiper', 'vertical_swiper_shortcode');
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'tcg_woocommerce_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'tcg_woocommerce_wrapper_end', 10 );
