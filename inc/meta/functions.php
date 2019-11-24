<?php
/**
 * Term meta front-end function
 */

/**
 * Modifies the theme layout on category page.
 *
 * @since  1.0.0
 */
function truereview_category_layout( $layout ) {

	// Per category layout
	if ( is_category() ) {

		// Get the layout
		$term_layout = esc_attr( truereview_get_term_meta( 'layout' ) );

		if ( $term_layout !== $layout ) {
			$layout = $term_layout;
		}

	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'truereview_category_layout', 15 );

/**
 * Per category color.
 *
 * @since  1.0.0
 */
function truereview_category_color() {

	// Only for category page
	if ( !is_category() ) {
		return;
	}

	// Get the color
	$id    = get_queried_object()->term_id;
	$color = truereview_get_term_color( $id, true );

	// Display the custom header via inline CSS.
	if ( $color && $color !== '#46a546' ) :
		$new_color = '
			.menu-secondary-container,
			.widget-title::after,
			.pagination .page-numbers.current,
			.pagination .page-numbers:hover,
			.menu-secondary-items .sub-menu a:hover { border-color: ' . $color . ' !important; }

			.searchform .submit-field,
			.pagination .page-numbers.current,
			.pagination .page-numbers:hover,
			.widget_newsletter button { background-color: ' . $color . ' !important; }

			a:hover,
			.entry-title a:hover,
			.entry-comment a:hover,
			.widget a:hover,
			.breaking-news a:hover,
			.page-title,
			.menu-primary-items a:hover,
			.entry-comment a,
			.site-info a:hover,
			.site-title a:hover,
			#menu-primary-items .mega-links a:hover,
			#menu-secondary-items .mega-links a:hover,
			.social-icons a:hover { color: ' . $color . ' !important; }
			';
	endif;

	if ( ! empty( $new_color ) ) :
		wp_add_inline_style( 'truereview-style', $new_color );
	endif;

}
add_action( 'wp_enqueue_scripts', 'truereview_category_color' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 */
function truereview_term_list_layout_classes( $classes ) {

	// Only for category page
	if ( is_category() ) {

		// Get the list layout
		$list = truereview_get_term_meta( 'list_layout' );

		// Get the featured posts style
		$style = truereview_get_term_meta( 'featured_style', 'slider' );

		// Our custom class
		$classes[] = 'list-layout-' . esc_attr( $list ) . '-style';
		$classes[] = 'featured-' . esc_attr( $style ) . '-style';

	}

	return $classes;
}
add_filter( 'body_class', 'truereview_term_list_layout_classes' );

/**
 * Control excerpt length.
 *
 * @since  1.0.0
 */
function truereview_term_excerpt_length( $length ) {

	// Default length
	$num = 20;

	if ( is_category() ) {
		// Get the list layout
		$list = truereview_get_term_meta( 'list_layout' );

		// Change the excerpt length on full width layout
		if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
			if ( $list === 'default' || $list === 'blog' ) {
				$num = 50;
			}
		}
	}

	return $num;
}
add_filter( 'excerpt_length', 'truereview_term_excerpt_length', 999 );
