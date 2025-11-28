<?php
/**
 * The main template file
 *
 * This file is the fallback template used to render pages and posts when a more
 * specific template is not available. It calls the header and footer templates
 * and runs the WordPress loop to output content in a builder-friendly way.
 *
 * @package TheyCallMeGordon
 */

get_header(); ?>

<?php
if (have_posts()):
    /* Start the Loop */
    while (have_posts()):
        the_post();

        // If this is a singular page/post, output full content (Elementor or classic).
        if (is_singular()): ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header mb-4">
					<?php // Title for singular views (can be hidden if Elementor provides header)
     if (apply_filters("theycallmegordon_show_title", true)): ?>
						<h1 class="entry-title text-2xl font-semibold"><?php the_title(); ?></h1>
					<?php endif; ?>
				</header>

				<div class="entry-content">
					<?php
     // Output content (Elementor content will be rendered here if used on the page)
     the_content();

     // Paginate paged posts
     wp_link_pages([
         "before" =>
             '<nav class="page-links" aria-label="' .
             esc_attr__("Page", "theycallmegordon") .
             '">',
         "after" => "</nav>",
     ]);
     ?>
				</div>
			</article>

		<?php
            // For archive-like contexts (blog index, category), show a summarized layout.

            else: ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class("mb-8"); ?>>
				<header class="entry-header">
					<h2 class="entry-title text-xl font-semibold">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
				</header>

				<div class="entry-summary mt-2 text-gray-700">
					<?php the_excerpt(); ?>
				</div>

				<footer class="entry-footer mt-3">
					<a class="read-more text-blue-600" href="<?php the_permalink(); ?>">
						<?php esc_html_e("Read more", "theycallmegordon"); ?>
					</a>
				</footer>
			</article>

		<?php endif;
    endwhile;

    // Posts pagination for archive/index contexts.
    the_posts_pagination([
        "prev_text" => esc_html__("&larr; Previous", "theycallmegordon"),
        "next_text" => esc_html__("Next &rarr;", "theycallmegordon"),
    ]);
else:
     ?>

	<section class="no-results not-found py-8">
		<header class="page-header">
			<h2 class="page-title text-xl font-semibold"><?php esc_html_e(
       "Nothing Found",
       "theycallmegordon",
   ); ?></h2>
		</header>

		<div class="page-content mt-4">
			<p><?php esc_html_e(
       "It seems we can’t find what you’re looking for. Try searching or use the links below.",
       "theycallmegordon",
   ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</section>

<?php
endif;

get_footer();

?>
