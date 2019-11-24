<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'single' ); ?>

				<?php truereview_entry_share(); // Display the post share buttons. ?>

				<?php truereview_next_prev_post(); // Display the next and previous post. ?>

				<?php truereview_post_author_box(); // Display the author box. ?>

				<?php truereview_related_posts(); // Display the related posts. ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
