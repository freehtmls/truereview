<?php
// Get the data set in customizer
$enable  = truereview_mod( PREFIX . 'featured-enable' );
$tag     = truereview_mod( PREFIX . 'featured-tag' );
$orderby = truereview_mod( PREFIX . 'featured-orderby' );

// Disable the posts slider by user selected in the customizer
if ( !$enable ) {
	return;
}

// Only show on home page
if ( !is_page_template( 'page-templates/home.php' ) ) {
	return;
}

// Posts query arguments.
$args = array(
	'posts_per_page' => 4,
	'post_type'      => 'post',
	'orderby'        => $orderby
);

// Include the tag.
if ( $tag ) {
	$args['tag_id'] = absint( $tag );
}

// Allow dev to filter the query.
$args = apply_filters( 'truereview_featured_posts_args', $args );

// The post query
$featured = new WP_Query( $args );

if ( $featured->have_posts() ) : ?>
	<div class="featured-posts">
		<div class="container">

			<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

				<?php if ( 0 === $featured->current_post ) : ?>

					<div class="featured-post-left">
						<?php if ( has_post_thumbnail() ) : ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'truereview-featured-big', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
								<span class="img-overlay"></span>
							</a>
						<?php endif; ?>
						<div class="featured-meta">
							<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
							<?php
								// Get the review score
								$type   = get_post_meta( get_the_ID(), 'tj_review_type', true );
								$review = get_post_meta( get_the_ID(), 'tj_review_feature', true );
								$avg = truereview_review_avg( array( 'type' => $type, 'count' => $review, 'progressbar' => true ) );
								if ( $avg ) :
							?>
								<span class="post-review">
									<span class="review-score">
										<span class="bar" style="width: <?php echo intval( $avg ) . '%'; ?>"></span>
									</span>
								</span>
							<?php endif; ?>
							<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						</div>
					</div>

				<?php else : ?>

					<?php if ( 1 === $featured->current_post ) :?>
						<div class="featured-post-right">
					<?php endif; ?>

						<?php if ( 1 === $featured->current_post ) : ?>

							<div class="featured-big">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="thumbnail-link" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'truereview-featured-medium', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
										<span class="img-overlay"></span>
									</a>
								<?php endif; ?>
								<div class="featured-meta">
									<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
									<?php
										// Get the review score
										$type   = get_post_meta( get_the_ID(), 'tj_review_type', true );
										$review = get_post_meta( get_the_ID(), 'tj_review_feature', true );
										$avg = truereview_review_avg( array( 'type' => $type, 'count' => $review, 'progressbar' => true ) );
										if ( $avg ) :
									?>
										<span class="post-review">
											<span class="review-score">
												<span class="bar" style="width: <?php echo intval( $avg ) . '%'; ?>"></span>
											</span>
										</span>
									<?php endif; ?>
									<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								</div>
							</div>

						<?php else : ?>

							<div class="featured-small">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="thumbnail-link" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
										<span class="img-overlay"></span>
									</a>
								<?php endif; ?>
								<div class="featured-meta">
									<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
									<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								</div>
							</div>

						<?php endif; ?>


					<?php if ( $featured->post_count === $featured->current_post + 1 ) : ?>
						</div>
					<?php endif; ?>

				<?php endif; ?>

			<?php endwhile; ?>

		</div>
	</div>
<?php endif; wp_reset_postdata(); ?>
