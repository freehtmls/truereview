<?php
/**
 * Template Name: Contact template
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" <?php hybrid_attr( 'content' ); ?>>
			<div class="posts-wrapper">

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

						<header class="entry-header">
							<?php the_title( '<h1 class="page-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
						</header><!-- .entry-header -->

						<?php
						$location = get_post_meta( get_the_ID(), 'tj_contact_maps', true );
						if ( !empty( $location ) ):
						?>
							<div class="acf-map">
								<div class="marker" data-lat="<?php echo esc_attr( $location['lat'] ); ?>" data-lng="<?php echo esc_attr( $location['lng'] ); ?>"></div>
							</div>
						<?php endif; ?>

						<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
							<?php the_content(); ?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'truereview' ),
									'after'  => '</div>',
								) );
							?>
						</div><!-- .entry-content -->

						<?php
							$shortcode = get_post_meta( get_the_ID(), 'tj_contact_form_shortcode', true );
							if ( $shortcode ) :
						?>
							<div class="form-contact">
								<h5 class="form-title widget-title"><?php esc_html_e( 'Contact Us', 'truereview' ) ?></h5>
								<?php echo do_shortcode( wp_kses_post( $shortcode ) ); ?>
							</div>
						<?php endif; ?>

						<?php edit_post_link( esc_html__( 'Edit', 'truereview' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

					</article>

				<?php endwhile; ?>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
