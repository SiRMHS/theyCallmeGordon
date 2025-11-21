<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<footer class="site-footer" role="contentinfo">
    <div class="wrap">
        <nav class="footer-navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
        </nav>
        <div class="site-info">
            &copy; <?php echo date_i18n( _x( 'Y', 'copyright date', 'pharmacy-store' ) ); ?> <?php bloginfo( 'name' ); ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
