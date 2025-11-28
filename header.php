<?php
/**
 * Theme Header
 *
 * Adds standard HTML head output, body classes and a site header/navigation.
 * Ensures compatibility with plugins (Elementor, WooCommerce) by exposing
 * `wp_head()`, `wp_body_open()` and providing an accessible skip link.
 *
 * Note: This template opens the main content area (`#site-content`) for
 * non-WooCommerce pages. WooCommerce templates are expected to use the
 * theme's WooCommerce wrappers (if active) to avoid duplicate <main>.
 *
 * @package TheyCallMeGordon
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo("charset"); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php // Hook for themes/plugins to inject immediately after body open.

if (function_exists("wp_body_open")) {
    wp_body_open();
} ?>

<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e(
    "Skip to content",
    "theycallmegordon",
); ?></a>

<div id="page" class="site min-h-screen flex flex-col">

	<header id="masthead" class="site-header bg-white shadow-sm" role="banner">
		<div class="site-branding container mx-auto px-4 flex items-center justify-between py-4">
			<div class="branding flex items-center gap-4">
				<?php if (function_exists("the_custom_logo") && has_custom_logo()) {
        the_custom_logo();
    } else {
         ?>
					<div class="site-title text-lg font-semibold">
						<a href="<?php echo esc_url(home_url("/")); ?>" rel="home"><?php bloginfo(
    "name",
); ?></a>
					</div>
					<?php
    } ?>
				<?php if (get_bloginfo("description")): ?>
					<div class="site-tagline hidden md:block text-sm text-gray-600">
						<?php bloginfo("description"); ?>
					</div>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e(
       "Primary Menu",
       "theycallmegordon",
   ); ?>">
				<?php wp_nav_menu([
        "theme_location" => "primary",
        "menu_class" => "primary-menu flex space-x-4",
        "container" => false,
        "fallback_cb" => "wp_page_menu",
    ]); ?>
			</nav>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<?php // Open main content area for non-WooCommerce pages. WooCommerce wrappers

// (if active) will echo their own <main id="site-content"> to avoid duplication.
 // Use class_exists('WooCommerce') checks to avoid diagnostics from static analysis.
 if (!class_exists("WooCommerce")) { ?>
		<main id="site-content" role="main" class="container mx-auto px-4 flex-1">
		<?php }
?>
