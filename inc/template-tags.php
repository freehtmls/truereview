<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'truereview_site_branding' ) ) :
/**
 * Site branding for the site.
 *
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 *
 * @since  1.0.0
 */
function truereview_site_branding() {

	// Get the customizer value.
	$logo_id  = truereview_mod( PREFIX . 'logo' );

	// Check if logo available, then display it.
	if ( $logo_id ) :
		echo '<div id="logo" itemscope itemtype="http://schema.org/Brand">' . "\n";
			echo '<a class="site-logo" href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home">' . "\n";
				echo '<img itemprop="logo" src="' . esc_url( wp_get_attachment_url( $logo_id ) ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<div id="logo">'. "\n";
			echo '<h1 class="site-title" ' . hybrid_get_attr( 'site-title' ) . '><a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home"><span itemprop="headline">' . esc_attr( get_bloginfo( 'name' ) ) . '</span></a></h1>'. "\n";
		echo '</div>'. "\n";
	endif;

}
endif;

if ( ! function_exists( 'truereview_social_icons' ) ) :
/**
 * Header social
 */
function truereview_social_icons( $position = 'header' ) {

	// Get the customizer data
	$tw        = truereview_mod( PREFIX . 'twitter' );
	$fb        = truereview_mod( PREFIX . 'facebook' );
	$gplus     = truereview_mod( PREFIX . 'gplus' );
	$instagram = truereview_mod( PREFIX . 'instagram' );
	$pinterest = truereview_mod( PREFIX . 'pinterest' );
	$linkedin  = truereview_mod( PREFIX . 'linkedin' );
	$rss       = truereview_mod( PREFIX . 'rss' );

	// Display the data
	if ( $tw || $fb || $gplus || $instagram || $pinterest || $rss ) {

		echo '<div id="' . $position . '-social" class="social-icons">';
			if ( $tw ) {
				echo '<a href="' . esc_url( $tw ) . '"><i class="fa fa-twitter"></i></a> ';
			}
			if ( $fb ) {
				echo '<a href="' . esc_url( $fb ) . '"><i class="fa fa-facebook"></i></a> ';
			}
			if ( $gplus ) {
				echo '<a href="' . esc_url( $gplus ) . '"><i class="fa fa-google-plus"></i></a> ';
			}
			if ( $instagram ) {
				echo '<a href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a> ';
			}
			if ( $pinterest ) {
				echo '<a href="' . esc_url( $pinterest ) . '"><i class="fa fa-pinterest"></i></a> ';
			}
			if ( $linkedin ) {
				echo '<a href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a> ';
			}
			if ( $rss ) {
				echo '<a href="' . esc_url( $rss ) . '"><i class="fa fa-rss"></i></a>';
			}
		echo '</div>';

	}

}
endif;

if ( ! function_exists( 'truereview_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function truereview_posted_on() {
	?>
	<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>" content="<?php echo esc_attr( get_the_title() ); ?>" />
	<meta itemprop="dateModified" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"/>
	<?php

	$time_string = '<time class="entry-date published" datetime="%1$s" ' . hybrid_get_attr( 'entry-published' ) . '>%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( esc_html__( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'truereview' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard" ' . hybrid_get_attr( 'entry-author' ) . '><a class="url fn n" href="%1$s" itemprop="url"><span itemprop="name">%2$s</span></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

if ( ! function_exists( 'truereview_categorized_blog' ) ) :
/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function truereview_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'truereview_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'truereview_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so truereview_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so truereview_categorized_blog should return false.
		return false;
	}
}
endif;

if ( ! function_exists( 'truereview_category_transient_flusher' ) ) :
/**
 * Flush out the transients used in truereview_categorized_blog.
 *
 * @since 1.0.0
 */
function truereview_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'truereview_categories' );
}
endif;
add_action( 'edit_category', 'truereview_category_transient_flusher' );
add_action( 'save_post',     'truereview_category_transient_flusher' );

if ( ! function_exists( 'truereview_post_category' ) ) :
/**
 * Post category.
 *
 * @since 1.0.0
 */
function truereview_post_category() {
	?>

		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				$categories = get_the_category();
				if ( $categories && truereview_categorized_blog() ) :
			?>
			<span class="cat-links" <?php hybrid_attr( 'entry-terms', 'category' ); ?>>
				<?php foreach( $categories as $category ) : ?>
					<?php $color = truereview_get_term_color( $category->term_id, true ); ?>
					<?php $color = $color ? $color : '#46a546'; ?>
					<a href="<?php echo esc_url( get_category_link( $category->term_id ) ) ?>" style="background-color: <?php echo sanitize_hex_color( $color ); ?>"><?php echo esc_html( $category->name ); ?></a>
				<?php endforeach; ?>
			</span>
			<?php endif; // End if categories ?>
		<?php endif; ?>

	<?php
}
endif;

if ( ! function_exists( 'truereview_post_thumbnail' ) ) :
/**
 * Post thumbnail.
 *
 * @since 1.0.0
 */
function truereview_post_thumbnail() {

	// Set up default thumbnail size
	$size = 'medium';

	// Category layout
	if ( is_category() ) {

		// Get the list layout
		$list = truereview_get_term_meta( 'list_layout' );

		if ( $list === 'blog' ) {
			$size = 'large';
		} elseif ( $list === 'masonry' ) {
			$size = 'truereview-masonry';
		}

	}

	// Get the image attributes
	$attr = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );

	?>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="thumbnail" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( $size, array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</a>
			<meta itemprop="url" content="<?php echo esc_url( $attr[0] ); ?>">
			<meta itemprop="width" content="<?php echo absint( $attr[1] ); ?>">
			<meta itemprop="height" content="<?php echo absint( $attr[2] ); ?>">
			<span class="format-icon"><?php echo truereview_format_icons(); ?></span>
		</div>
	<?php endif; ?>
	<?php
}
endif;

if ( ! function_exists( 'truereview_format_icons' ) ) :
/**
 * Post formats icon.
 *
 * @since 1.0.0
 */
function truereview_format_icons() {

	// Set up empty variable
	$icon = '';

	if ( has_post_format( 'audio' ) ) {
		$icon = '<i class="fa fa-music"></i>';
	} elseif ( has_post_format( 'video' ) ) {
		$icon = '<i class="fa fa-play"></i>';
	} elseif ( has_post_format( 'gallery' ) ) {
		$icon = '<i class="fa fa-camera-retro"></i>';
	}

	return $icon;

}
endif;

if ( ! function_exists( 'truereview_format_gallery' ) ) :
/**
 * Format gallery
 *
 * @since  1.0.0
 */
function truereview_format_gallery() {

	// Get the metabox data
	$images = get_post_meta( get_the_ID(), 'tj_format_gallery', true );

	// Display the gallery
	if ( $images ) {
		echo '<div class="format-gallery featured-posts flexslider">';
			echo '<ul class="slides images">';
				foreach( $images as $image ):
					echo '<li class="image">';
						echo wp_get_attachment_image( $image, 'large' );
					echo '</li>';
				endforeach;
			echo '</ul>';
		echo '</div>';
	}

}
endif;

if ( ! function_exists( 'truereview_format_video' ) ) :
/**
 * Format video
 *
 * @since  1.0.0
 */
function truereview_format_video() {

	// Get the metabox data
	$embed  = get_post_meta( get_the_ID(), 'tj_format_video_embed', true );
	$upload = get_post_meta( get_the_ID(), 'tj_format_video_upload', true );

	// Display the video
	if ( $embed ) {
		echo wp_oembed_get( $embed );
	} elseif ( $upload ) {
		// Get the video url/
		$url = wp_get_attachment_url( $upload );

		// Display the video.
		echo do_shortcode( '[video width="1050" src="' . $url . '"]' );
	}

}
endif;

if ( ! function_exists( 'truereview_format_audio' ) ) :
/**
 * Format audio
 *
 * @since  1.0.0
 */
function truereview_format_audio() {

	// Get the metabox data
	$embed  = get_post_meta( get_the_ID(), 'tj_format_audio_embed', true );
	$upload = get_post_meta( get_the_ID(), 'tj_format_audio_upload', true );

	// Display the audio
	if ( $embed ) {
		echo wp_oembed_get( $embed );
	} elseif ( $upload ) {
		// Get the audio url/
		$url = wp_get_attachment_url( $upload );

		// Display the audio.
		echo do_shortcode( '[audio width="1050" src="' . $url . '"]' );
	}

}
endif;

if ( ! function_exists( 'truereview_entry_share' ) ) :
/**
 * Social share.
 *
 * @since 1.0.0
 */
function truereview_entry_share() {
	?>
		<div class="entry-share">
			<ul>
				<li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( esc_attr( get_the_title( get_the_ID() ) ) ); ?>&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a></li>
				<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a></li>
				<li class="google-plus"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><i class="fa fa-google-plus"></i> <span>Google+</span></a></li>
				<li class="linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;title=<?php echo urlencode( esc_attr( get_the_title( get_the_ID() ) ) ); ?>" target="_blank"><i class="fa fa-linkedin"></i> <span>Linkedin</span></a></li>
				<li class="pinterest"><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;media=<?php echo urlencode( wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) ); ?>" target="_blank"><i class="fa fa-pinterest"></i> <span>Pinterest</span></a></li>
				<li class="email"><a href="mailto:?subject=<?php echo esc_url( urlencode( '[' . get_bloginfo( 'name' ) . '] ' . get_the_title( get_the_ID() ) ) ); ?>&amp;body=<?php echo esc_url( urlencode( get_permalink( get_the_ID() ) ) ); ?>"><i class="fa fa-envelope"></i> <span><?php esc_html_e( 'Email', 'truereview' ); ?></span></a></li>
			</ul>
		</div>
	<?php
}
endif;

if ( ! function_exists( 'truereview_next_prev_post' ) ) :
/**
 * Custom next post link
 *
 * @since 1.0.0
 */
function truereview_next_prev_post() {

	// Display on single post page.
	if ( ! is_single() ) {
		return;
	}

	// Get the next and previous post id.
	$next = get_adjacent_post( false, '', false );
	$prev = get_adjacent_post( false, '', true );
?>
	<div class="post-pagination">

		<?php if ( $prev ) : ?>
			<div class="prev-post">

				<?php if ( has_post_thumbnail( $prev->ID ) ) : ?>
					<a class="thumbnail-link" href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>"><?php echo get_the_post_thumbnail( $prev->ID, 'thumbnail', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $prev->ID ) ) ) ) ?></a>
				<?php endif; ?>

				<div class="post-detail">
					<span><?php esc_html_e( 'Previous Post', 'truereview' ); ?></span>
					<a href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>" class="post-title"><?php echo esc_attr( get_the_title( $prev->ID ) ); ?></a>
				</div>

			</div>
		<?php endif; ?>

		<?php if ( $next ) : ?>
			<div class="next-post">

				<?php if ( has_post_thumbnail( $next->ID ) ) : ?>
					<a class="thumbnail-link" href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>"><?php echo get_the_post_thumbnail( $next->ID, 'thumbnail', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $next->ID ) ) ) ) ?></a>
				<?php endif; ?>

				<div class="post-detail">
					<span><?php esc_html_e( 'Next Post', 'truereview' ); ?></span>
					<a href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>" class="post-title"><?php echo esc_attr( get_the_title( $next->ID ) ); ?></a>
				</div>

			</div>
		<?php endif; ?>

	</div>
<?php
}
endif;

if ( ! function_exists( 'truereview_entry_publisher' ) ) :
/**
 * Schema.org publisher
 */
function truereview_entry_publisher() {
	?>
	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
		<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
			<?php
			$logo_id = truereview_mod( PREFIX . 'logo' );
			if ( $logo_id ) {
				$logo_url = wp_get_attachment_url( $logo_id );
			} else {
				$logo_url = '//placehold.it/91x30';
			}
			?>
			<meta itemprop="url" content="<?php echo esc_url( $logo_url ); ?>">
			<meta itemprop="width" content="300">
			<meta itemprop="height" content="200">
		</div>
		<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	</div>
	<?php
}
endif;

if ( ! function_exists( 'truereview_post_author_box' ) ) :
/**
 * Author post informations.
 *
 * @since  1.0.0
 */
function truereview_post_author_box() {

	// Bail if not on the single post.
	if ( ! is_single() || is_attachment() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Get the author social information.
	$url       = get_the_author_meta( 'url' );
?>

	<div class="author-bio clearfix" <?php hybrid_attr( 'entry-author' ) ?>>
		<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'truereview_author_bio_avatar_size', 96 ), '', strip_tags( get_the_author() ) ); ?>
		<div class="description">

			<h3 class="author-title name">
				<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></a>
			</h3>

			<p class="bio" itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>

		</div>
	</div><!-- .author-bio -->

<?php
}
endif;

if ( ! function_exists( 'truereview_related_posts' ) ) :
/**
 * Related posts.
 *
 * @since  1.0.0
 */
function truereview_related_posts() {

	// Get the data set in customizer
	$enable  = truereview_mod( PREFIX . 'related-posts' );
	$img     = truereview_mod( PREFIX . 'related-posts-img' );

	// Disable if user choose it.
	if ( $enable == 0 ) {
		return;
	}

	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Posts query arguments.
	$query = array(
		'post__not_in' => array( get_the_ID() ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 3,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'truereview_related_posts_args', $query );

	// The post query
	$related = new WP_Query( $args );

	if ( $related->have_posts() ) : ?>

		<div class="related-posts">
			<h3><?php esc_html_e( 'Related Articles', 'truereview' ); ?></h3>
			<ul>
				<?php while ( $related->have_posts() ) : $related->the_post(); ?>
					<li>
						<?php if ( has_post_thumbnail() && $img ) : ?>
							<a class="thumbnail-link" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
						<?php endif; ?>
						<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<time class="published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'truereview_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function truereview_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">
			<p <?php hybrid_attr( 'comment-content' ); ?>><?php esc_html_e( 'Pingback:', 'truereview' ); ?> <span <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php comment_author_link(); ?></span></span> <?php edit_comment_link( esc_html__( '(Edit)', 'truereview' ), '<span class="edit-link">', '</span>' ); ?></p>
		</article>
	<?php
			break;
		default :
		// Proceed with normal comments.
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">

			<div class="comment-avatar">
				<?php echo get_avatar( $comment, apply_filters( 'truereview_comment_avatar_size', 80 ) ); ?>
				<span class="name" <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php echo get_comment_author_link(); ?></span></span>
				<?php echo truereview_comment_author_badge(); ?>
			</div>

			<div class="comment-body">
				<div class="comment-wrapper">

					<div class="comment-head">
						<?php
							$edit_comment_link = '';
							if ( get_edit_comment_link() )
								$edit_comment_link = sprintf( esc_html__( '&middot; %1$sEdit%2$s', 'truereview' ), '<a href="' . get_edit_comment_link() . '" title="' . esc_attr__( 'Edit Comment', 'truereview' ) . '">', '</a>' );

							printf( '<span class="date"><a href="%1$s" ' . hybrid_get_attr( 'comment-permalink' ) . '><time datetime="%2$s" ' . hybrid_get_attr( 'comment-published' ) . '>%3$s</time></a> %4$s</span>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s at %2$s', 'truereview' ), get_comment_date(), get_comment_time() ),
								$edit_comment_link
							);
						?>
					</div><!-- comment-head -->

					<div class="comment-content comment-entry" <?php hybrid_attr( 'comment-content' ); ?>>
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'truereview' ); ?></p>
						<?php endif; ?>
						<?php comment_text(); ?>
						<span class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => wp_kses_post( __( '<i class="fa fa-reply"></i> Reply', 'truereview' ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</span><!-- .reply -->
					</div><!-- .comment-content -->

				</div>
			</div>

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'truereview_comment_author_badge' ) ) :
/**
 * Custom badge for post author comment
 *
 * @since  1.0.0
 */
function truereview_comment_author_badge() {

	// Set up empty variable
	$output = '';

	// Get comment classes
	$classes = get_comment_class();

	if ( in_array( 'bypostauthor', $classes ) ) {
		$output = '<span class="author-badge">' . esc_html__( 'Author', 'truereview' ) . '</span>';
	}

	// Display the badge
	return apply_filters( 'truereview_comment_author_badge', $output );
}
endif;

if ( ! function_exists( 'truereview_get_first_image' ) ) :
/**
 * Return an HTML img tag for the first image in a post content. Used to draw
 * the content for posts of the “image” format.
 * http://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/#comment-1582091 --> not working
 * http://www.wprecipes.com/how-to-get-the-first-image-from-the-post-and-display-it
 *
 * @return string An HTML img tag for the first image in a post content.
 */
function truereview_get_first_image( $size = 'full', $echo = true ) {

	// TO-DO: handle when $echo is false
	if ( has_post_thumbnail() && $echo ) {
		return truereview_featured_image( $size );
	}

	// Expose information about the current post.
	global $post;

	// We'll trap to see if this stays empty later in the function.
	$src = '';

	// Grab all img src's in the post content
	// $output = preg_match_all( '//i', $post->post_content, $matches ); // not working
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

	// Grab the first img src returned by our regex.
	// if ( ! isset ( $matches[1][0] ) ) { return false; }
	// $src = $matches[1][0];

	// Grab the first <img> complete markup returned by our regex.
	if ( ! isset ( $matches[0][0] ) ) { return false; }
	$src = $matches[0][0];

	// Make sure there's still something worth outputting after sanitization.
	if ( empty( $src ) ) { return false; }

	// add wrapper
	$content = '<div class="entry-image clearfix">';
		$content .= '<a class="img-link" href="' . get_the_permalink() . '">';
			$content .= $src;
		$content .= '</a>';
	$content .= '</div>';

	// choose whether to echo the result or return it as variable
	if ( true == $echo )
		echo $content;
	else
		return $src;

}
endif;

if ( ! function_exists( 'truereview_footer_text' ) ) :
/**
 * Footer Text
 *
 * @since  1.0.0
 */
function truereview_footer_text() {

	// Get the customizer data
	$footer_text = truereview_mod( PREFIX . 'footer-text' );

	// Polylang integration
	if ( is_polylang_activated() ) {
		$footer_text = pllesc_html__( truereview_mod( PREFIX . 'footer-text' ) );
	}

	// Display the data
	echo '<p class="copyright">' . stripslashes( $footer_text ) . '</p>';

}
endif;
