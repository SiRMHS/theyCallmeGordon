<?php
/**
 * Main template file - basic loop
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>
<main class="site-main">
    <div class="wrap">
        <?php if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/content', get_post_type() );
            endwhile;
            the_posts_pagination();
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif; ?>
    </div>
</main>

<?php get_footer(); ?>
