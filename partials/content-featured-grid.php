<?php
// Get the term meta data
$term_id     = get_queried_object()->term_id;
$term_enable = get_term_meta( $term_id, 'featured', true );

// Get the term layout
$term_layout = esc_attr( truereview_get_term_meta( 'layout' ) );

// Get the data set in customizer
$enable  = truereview_mod( PREFIX . 'featured-enable' );
$tag     = truereview_mod( PREFIX . 'featured-tag' );
$orderby = truereview_mod( PREFIX . 'featured-orderby' );

// Disable by user selected on category edit page
if ( !$term_enable ) {
	return;
}

// Disable the posts slider by user selected in the customizer
if ( !$enable ) {
	return;
}

// Posts query arguments.
$args = array(
	'posts_per_page' => 3,
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
		<?php $i = 0; ?>
		<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

			<?php if ( ++$i === 1 ) :  ?>
				<div class="featured-item-big">
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
						</a>
					<?php endif; ?>
					<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<div class="featured-meta">
						<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
							<span class="entry-comment"><?php comments_popup_link( esc_html__( '0 Comment', 'truereview' ), esc_html__( '1 Comment', 'truereview' ), esc_html__( '% Comments', 'truereview' ) ); ?></span>
						<?php endif; ?>
					</div>
					<div class="featured-summary">
						<?php the_excerpt(); ?>
					</div>
				</div>
			<?php else : ?>
				<?php
					$size = 'post-thumbnail';
					if ( $term_layout === '1c' ) {
						$size = 'post-thumbnail';
					}
				?>
				<div class="featured-item-small">
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( $size, array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
						</a>
					<?php endif; ?>
					<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					<div class="featured-meta">
						<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
							<span class="entry-comment"><?php comments_popup_link( esc_html__( '0 Comment', 'truereview' ), esc_html__( '1 Comment', 'truereview' ), esc_html__( '% Comments', 'truereview' ) ); ?></span>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
<?php endif; wp_reset_postdata(); ?>
