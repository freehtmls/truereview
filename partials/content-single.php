<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>" content="<?php echo esc_attr( get_the_title() ); ?>" />
	<meta itemprop="dateModified" content="<?php echo esc_html( get_the_modified_date( 'c' ) ); ?>" />

	<?php if ( has_post_thumbnail() ) : ?>
		<?php $attr = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
		<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<meta itemprop="url" content="<?php echo esc_url( $attr[0] ); ?>">
			<meta itemprop="width" content="<?php echo absint( $attr[1] ); ?>">
			<meta itemprop="height" content="<?php echo absint( $attr[2] ); ?>">
		</span>
	<?php endif; ?>

	<header class="entry-header">
		<?php truereview_post_category(); ?>
		<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
	</header>

	<div class="entry-byline">
		<div class="byline-left">
			<span class="entry-author author vcard" <?php hybrid_attr( 'entry-author' ) ?>><?php printf( esc_html__( 'By %s', 'truereview' ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" itemprop="url"><span itemprop="name">' . esc_html( get_the_author() ) . '</span></a>' ); ?></span>
			<time class="entry-date published" datetime="<?php echo esc_html( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php printf( esc_html__( ' - %s', 'truereview' ), esc_html( get_the_date() ) ); ?></time>
		</div>
		<div class="byline-right">
			<span class="entry-view"><?php echo truereview_entry_views_get( array( 'before' => '<i class="fa fa-eye"></i>' ) ); ?></span>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="entry-comment"><i class="fa fa-comments"></i> <?php comments_popup_link( esc_html__( '0', 'truereview' ), esc_html__( '1', 'truereview' ), esc_html__( '%', 'truereview' ) ); ?></span>
			<?php endif; ?>
		</div>
	</div>

	<?php truereview_entry_share(); ?>

	<?php if ( has_post_format( 'video' ) ) : ?>
		<div class="entry-format">
			<?php truereview_format_video(); ?>
		</div>
	<?php elseif ( has_post_format( 'audio' ) ) : ?>
		<div class="entry-format">
			<?php truereview_format_audio(); ?>
		</div>
	<?php elseif ( has_post_format( 'gallery' ) ) : ?>
		<div class="entry-format">
			<?php truereview_format_gallery(); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'           => '<div class="page-links">',
				'after'            => '</div>',
				'next_or_number'   => 'next',
				'nextpagelink'     => esc_html__( 'Next', 'truereview' ),
				'previouspagelink' => esc_html__( 'Previous', 'truereview' )
			) );
		?>

	</div>

	<footer class="entry-footer">

		<?php
			$tags = get_the_tags();
			if ( $tags ) :
		?>
			<span class="tag-links" <?php hybrid_attr( 'entry-terms', 'post_tag' ); ?>>
				<span><?php esc_html_e( 'Tags: ', 'truereview' ); ?></span>
				<?php foreach( $tags as $tag ) : ?>
					<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_attr( '#' . $tag->name ); ?></a>
				<?php endforeach; ?>
			</span>
		<?php endif; ?>

	</footer>

</article><!-- #post-## -->
