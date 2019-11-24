<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>

			<?php if ( have_posts() ) : ?>

				<header class="page-header author-bio" <?php hybrid_attr( 'entry-author' ) ?>>
					<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'truereview_author_bio_avatar_size', 90 ), '', esc_attr( get_the_author() ) ); ?>
					<div class="description">
						<h3 class="author-title name">
							<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></a>
						</h3>
						<p class="bio" itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
					</div>
				</header><!-- .page-header -->

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
