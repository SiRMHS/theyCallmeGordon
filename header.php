<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" role="banner">
    <div class="wrap">
        <div class="site-branding">
            <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
                the_custom_logo();
            else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            <?php endif; ?>
        </div>
        <nav class="primary-navigation" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </nav>
    </div>
</header>
