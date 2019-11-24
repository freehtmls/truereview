<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php
					// Get data set in customizer
					$comment = truereview_mod( PREFIX . 'page-comment' );

					// Check if comment enable on customizer
					if ( $comment ) :
						// If enable and comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
