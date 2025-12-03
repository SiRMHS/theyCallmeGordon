<?php
// functions.php — enqueue CDN assets, register supports for Elementor & WooCommerce
add_theme_support("post-thumbnails");
add_theme_support("title-tag");
function mytheme_elementor_support()
{
    add_theme_support("elementor", [
        "wp-page-templates" => true,
        "post-thumbnails" => true,
    ]);
    add_post_type_support("page", "elementor");
    add_post_type_support("post", "elementor");
}
add_action("after_setup_theme", "mytheme_elementor_support");

if (!function_exists("tcg_setup_theme")) {
    function tcg_setup_theme()
    {
        add_theme_support("title-tag");
        add_theme_support("post-thumbnails");
        add_theme_support("automatic-feed-links");
        add_theme_support("html5", [
            "search-form",
            "comment-form",
            "comment-list",
            "gallery",
            "caption",
        ]);
        add_theme_support("woocommerce");
        add_theme_support("align-wide");
        register_nav_menus([
            "primary" => __("Primary Menu", "theycallmegordon"),
        ]);
    }
    add_action("after_setup_theme", "tcg_setup_theme");
}

function tcg_enqueue_assets()
{
    // Tailwind via Play CDN (in head)
    wp_enqueue_script(
        "tailwind-cdn",
        "https://cdn.tailwindcss.com",
        [],
        null,
        false,
    );
    // Swiper
    wp_enqueue_style(
        "swiper-css",
        "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css",
        [],
        "10",
    );
    wp_enqueue_script(
        "swiper",
        "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js",
        [],
        "10",
        true,
    );

    // GSAP
    wp_enqueue_script(
        "gsap",
        "https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js",
        [],
        "3.12.2",
        true,
    );

    // Barba (UMD build)
    wp_enqueue_script(
        "barba",
        "https://unpkg.com/@barba/core/dist/barba.umd.js",
        [],
        null,
        true,
    );

    // Theme main stylesheet (style.css exists; Tailwind handles layout)
    wp_enqueue_style(
        "tcg-style",
        get_stylesheet_uri(),
        ["swiper-css"],
        wp_get_theme()->get("Version"),
    );

    // Theme app JS (initializes Swiper/Barba/GSAP hooks)
    wp_enqueue_script(
        "tcg-app",
        get_theme_file_uri("/assets/js/app.js"),
        ["swiper", "gsap", "barba"],
        null,
        true,
    );
}
add_action("wp_enqueue_scripts", "tcg_enqueue_assets");

// WooCommerce basic wrappers so templates fit theme markup
function tcg_woocommerce_wrapper_start()
{
    echo '<main id="site-content" role="main" class="container mx-auto px-4">';
}
function tcg_woocommerce_wrapper_end()
{
    echo "</main>";
}

function vertical_swiper_shortcode()
{
    wp_enqueue_style(
        "my-swiper-style",
        get_stylesheet_directory_uri() . "/assets/css/swiper-style1.css",
        [],
        null,
    );
    wp_enqueue_script(
        "my-swiper-init",
        get_stylesheet_directory_uri() . "/assets/js/swiper1.js",
        ["swiper"],
        null,
        true,
    );

    ob_start();
    ?>
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
    <?php return ob_get_clean();
}
function info_destop()
{
    wp_enqueue_style(
        "info_destop",
        get_stylesheet_directory_uri() . "/assets/css/info_destop.css",
        [],
        null,
    );

    ob_start();
    ?>
    <div class="info-destop">
        <svg viewBox="0 0 24 24"> <use xlink:href="/assets/svg/info_detsop.svg"></use></svg>
    </div>
    <?php return ob_get_clean();
}
function info_mobail()
{
    wp_enqueue_style(
        "info_mobail",
        get_stylesheet_directory_uri() . "/assets/css/info_mobail.css",
        [],
        null,
    );
    ob_start();
    ?>
    <div class="info-mobail">
        <svg viewBox="0 0 24 24"> <use xlink:href="/assets/svg/info_mobail.svg"></use></svg>
    </div>
    <?php return ob_get_clean();
}
function project_swiper_shortcode()
{
    wp_enqueue_style(
        "info_mobail",
        get_stylesheet_directory_uri() . "/assets/css/project_swiper.css",
        [],
        null,
    );
    wp_enqueue_script(
        "my-swiper-init",
        get_stylesheet_directory_uri() . "/assets/js/project_swiper.js",
        ["swiper"],
        null,
        true,
    );
    ob_start();
    ?>
    <div class="wrap">


        <div class="swiper" aria-live="off">
            <div class="swiper-wrapper">
                <!-- اسلاید 1 -->
                <div class="swiper-slide">
                    <div class="chip-row">
                        <div class="chip">
تحقیق و تحلیل
                        </div>
                        <div class="icon-chip">
                            <img src="assets/svg/icon1.svg" alt="icon" />
                        </div>
                    </div>

                    <div class="desc">
در این مرحله هدف، شناخت دقیق کاربران نهایی، نیازها، رفتارها و اهداف اون‌هاست. داده‌ها از طریق مصاحبه، نظرسنجی، و تحلیل رقبا جمع‌آوری می‌شن تا مسیر طراحی دقیق‌تر و هدفمندتر پیش بره.
                    </div>
                    <img src="assets/img/pic1.jpg" class="card-image" alt="" />
                </div>

                <!-- اسلاید 2 -->
                <div class="swiper-slide">
                    <div class="chip-row">
                        <div class="chip">طراحی وایرفریم و ساختار</div>
                        <div class="icon-chip">
                            <img src="assets/svg/icon2.svg" alt="icon" />
                        </div>
                    </div>

                    <div class="desc">
                        در این بخش، ساختار کلی صفحات، چیدمان عناصر و جریان کاربر در محصول مشخص می‌شن. تمرکز اصلی بر سادگی، مسیر دسترسی و سازماندهی اطلاعاته تا کاربر تجربه روانی از تعامل با محصول داشته باشه.
                    </div>
                    <img src="assets/img/pic2.jpg" class="card-image" alt="" />
                </div>

                <!-- اسلاید 3 -->
                <div class="swiper-slide">
                    <div class="chip-row">
                        <div class="chip">تحقیق و تحلیل</div>
                        <div class="icon-chip">
                            <img src="assets/svg/icon3.svg" alt="icon" />
                        </div>
                    </div>
                    <div class="desc">
در این مرحله هدف، شناخت دقیق کاربران نهایی، نیازها، رفتارها و اهداف اون‌هاست. داده‌ها از طریق مصاحبه، نظرسنجی، و تحلیل رقبا جمع‌آوری می‌شن تا مسیر طراحی دقیق‌تر و هدفمندتر پیش بره.
                    </div>
                    <img src="assets/img/pic3.jpg" class="card-image" alt="" />
                </div>
            </div>
        </div>
    </div>
    <?php return ob_get_clean();
}
add_shortcode("project_swiper", "project_swiper_shortcode");
add_shortcode("hero_bg", "hero_bg");
add_shortcode("info_destop", "info_destop");
add_shortcode("info_mobail", "info_mobail");
add_shortcode("vertical_swiper", "vertical_swiper_shortcode");
remove_action(
    "woocommerce_before_main_content",
    "woocommerce_output_content_wrapper",
    10,
);
remove_action(
    "woocommerce_after_main_content",
    "woocommerce_output_content_wrapper_end",
    10,
);
add_action(
    "woocommerce_before_main_content",
    "tcg_woocommerce_wrapper_start",
    10,
);
add_action("woocommerce_after_main_content", "tcg_woocommerce_wrapper_end", 10);
