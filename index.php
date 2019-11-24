<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>

			<?php if ( have_posts() ) : ?>

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
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
