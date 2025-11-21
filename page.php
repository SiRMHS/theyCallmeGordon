<?php
/**
 * Page template — ensures `the_content()` is called so page builders (Elementor) render correctly.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>
<main class="site-main">
    <div class="wrap">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="entry-content">
                        <?php
                        /* This is important for Elementor and other page builders — they hook into the_content(). */
                        the_content();
                        ?>
                    </div>

                    <?php
                    // If comments are enabled, show them
                    if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
                    ?>
                </article>

            <?php
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif; ?>
    </div>
</main>

<?php get_footer();
