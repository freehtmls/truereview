<?php
// Get the data set in Customize
$enable = truereview_mod( PREFIX . 'breaking-news-enable' );
$tag    = truereview_mod( PREFIX . 'breaking-news-tag' );
$num    = truereview_mod( PREFIX . 'breaking-news-num' );
$order  = truereview_mod( PREFIX . 'breaking-news-orderby' );

// Return early if disabled
if ( !$enable ) {
	return;
}

// Posts query arguments.
$args = array(
	'posts_per_page' => absint( $num ),
	'post_type'      => 'post',
	'orderby'        => esc_attr( $order )
);

// Include the tag
if ( $tag ) {
	$args['tag_id'] = absint( $tag );
}

// Allow dev to filter the post arguments.
$query = apply_filters( 'truereview_breaking_news_args', $args );

// The post query.
$breaking = new WP_Query( $query );

if ( $breaking->have_posts() ) : ?>

	<div class="breaking-news">
		<h3><?php esc_html_e( 'Breaking News', 'truereview' ); ?></h3>
		<ul class="slides items">
			<?php while ( $breaking->have_posts() ) : $breaking->the_post(); ?>
				<li class="item">
					<?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?>
					<span class="breaking-date"><?php printf( esc_html__( '%s ago', 'truereview' ), human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

<?php endif; wp_reset_postdata(); ?>
