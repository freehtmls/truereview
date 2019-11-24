<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<?php the_post_navigation(); ?>

<?php elseif ( is_attachment() && wp_attachment_is_image() ) : // If viewing the attachment page. ?>

	<div class="attachment-nav">
		<div class="prev"><?php previous_image_link( false, esc_html__( '&laquo; Previous Image', 'truereview' ) ); ?></div>
		<div class="next"><?php next_image_link( false, esc_html__( 'Next Image &raquo;', 'truereview' ) ); ?></div>
	</div><!-- .loop-nav -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(); ?>

<?php endif; ?>
