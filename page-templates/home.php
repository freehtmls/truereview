<?php
/**
 * Template Name: Home template
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>
			<div class="posts-wrapper">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; ?>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
