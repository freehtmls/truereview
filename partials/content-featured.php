<?php
// Get the term meta data
$term_id   = get_queried_object()->term_id;
$term_enable = get_term_meta( $term_id, 'featured', true );

// Get the data set in customizer
$enable  = truereview_mod( PREFIX . 'featured-enable' );
$tag     = truereview_mod( PREFIX . 'featured-tag' );
$num     = truereview_mod( PREFIX . 'featured-num' );
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
	'posts_per_page' => $num,
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
	<div class="featured-posts flexslider">
		<ul class="slides">
			<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
				<li class="featured-item">
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="thumbnail-link" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
							<span class="img-overlay"></span>
						</a>
					<?php endif; ?>
					<div class="featured-meta">
						<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
						<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; wp_reset_postdata(); ?>
