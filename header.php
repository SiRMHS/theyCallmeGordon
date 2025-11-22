<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<header class="site-header bg-white shadow-sm">
    <div class="container mx-auto px-4 flex items-center justify-between py-4">
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-bold">TheyCallMeGordon</a>
        </div>
        <nav class="main-nav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex gap-4',
            ) );
            ?>
        </nav>
    </div>
</header>
