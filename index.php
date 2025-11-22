<?php get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-8' ); ?>>
            <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
            <div class="prose max-w-none">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; else: ?>
        <p><?php esc_html_e( 'هیچ محتوایی یافت نشد.', 'theycallmegordon' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
