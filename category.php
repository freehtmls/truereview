<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
					// Get the featured posts style
					$style = truereview_get_term_meta( 'featured_style', 'slider' );

					if ( $style === 'slider' ) {
						get_template_part( 'partials/content', 'featured' );
					} else {
						get_template_part( 'partials/content', 'featured-grid' );
					}
				?>

				<div class="page-entry">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'partials/content', get_post_format() ); ?>

					<?php endwhile; ?>

				</div>

				<?php get_template_part( 'pagination' ); // Loads the pagination.php template  ?>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
