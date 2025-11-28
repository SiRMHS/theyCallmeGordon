<?php
/**
 * Theme Footer
 *
 * Closes the main content area opened by header.php (for non-WooCommerce pages),
 * renders the site footer, triggers wp_footer(), and closes the HTML document.
 *
 * @package TheyCallMeGordon
 */

if (!class_exists("WooCommerce")) {
    // Close the <main id="site-content"> opened in header.php for non-WooCommerce pages.
    echo "</main><!-- #site-content -->";
} ?>

<footer id="colophon" class="site-footer bg-gray-100 py-8" role="contentinfo">
    <div class="container mx-auto px-4 text-center">
        <div class="site-info text-sm text-gray-600">
            &copy; <?php echo esc_html(date("Y")); ?> <?php echo esc_html(
     get_bloginfo("name"),
 ); ?>.
            <?php esc_html_e("All rights reserved.", "theycallmegordon"); ?>
        </div>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
