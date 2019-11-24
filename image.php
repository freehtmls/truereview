<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
						<?php get_template_part( 'pagination' ); ?>
					</header>

					<div class="entry-attachment">

						<div class="attachment">
							<?php
								/**
								 * Filter the default Leda image attachment size.
								 */
								$image_size = apply_filters( 'truereview_attachment_size', 'full' );

								echo wp_get_attachment_image( get_the_ID(), $image_size );
							?>

						</div><!-- .entry-attachment -->

						<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
							<?php the_content(); ?>
						</div>

					</div>

				</article><!-- #post-## -->

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
