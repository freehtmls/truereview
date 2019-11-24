<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php truereview_post_thumbnail(); ?>

	<div class="entry-wrapper">

		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header>

		<div class="entry-meta">
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
			<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_the_date() ); ?></a></time>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="entry-comment"><?php comments_popup_link( esc_html__( '0 Comment', 'truereview' ), esc_html__( '1 Comment', 'truereview' ), esc_html__( '% Comments', 'truereview' ) ); ?></span>
			<?php endif; ?>
		</div>

		<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div>

		<?php truereview_entry_publisher(); ?>

	</div>

</article><!-- #post-## -->
