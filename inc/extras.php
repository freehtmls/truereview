<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the body element.
 * @return array
 */
function truereview_body_classes( $classes ) {

	// Adds a class of multi-author to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'multi-author';
	}

	// Container layouts
	$container = truereview_mod( PREFIX . 'container-layouts' );
	$classes[] = 'container-' . $container;

	// Header date
	$date = truereview_mod( PREFIX . 'date-header' );
	if ( $date ) {
		$classes[] = 'has-date';
	}

	// Default layout
	if ( !is_category() && !is_singular() ) {
		$classes[] = 'default-list-style';
	}

	return $classes;
}
add_filter( 'body_class', 'truereview_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since  1.0.0
 * @param  array $classes Classes for the post element.
 * @return array
 */
function truereview_post_classes( $classes ) {

	// Adds a class if a post hasn't a thumbnail.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'truereview_post_classes' );

/**
 * Change the excerpt more string.
 *
 * @since  1.0.0
 * @param  string  $more
 * @return string
 */
function truereview_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'truereview_excerpt_more' );

/**
 * Control excerpt length.
 *
 * @since  1.0.0
 */
function truereview_excerpt_length( $length ) {

	$num = 20;

	// Change the excerpt length on full width layout
	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$num = 50;
	}

	return $num;
}
add_filter( 'excerpt_length', 'truereview_excerpt_length', 999 );

/**
 * Remove theme-layouts meta box on attachment and bbPress post type.
 *
 * @since 1.0.0
 */
function truereview_remove_theme_layout_metabox() {
	remove_post_type_support( 'attachment', 'theme-layouts' );

	// bbPress
	remove_post_type_support( 'forum', 'theme-layouts' );
	remove_post_type_support( 'topic', 'theme-layouts' );
	remove_post_type_support( 'reply', 'theme-layouts' );
}
add_action( 'init', 'truereview_remove_theme_layout_metabox', 11 );

/**
 * Add post type 'post' support for the Simple Page Sidebars plugin.
 *
 * @since  1.0.0
 */
function truereview_page_sidebar_plugin() {
	if ( class_exists( 'Simple_Page_Sidebars' ) ) {
		add_post_type_support( 'post', 'simple-page-sidebars' );
	}
}
add_action( 'init', 'truereview_page_sidebar_plugin' );

/**
 * Extend archive title
 *
 * @since  1.0.0
 */
function truereview_extend_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'truereview_extend_archive_title' );

/**
 * Customize tag cloud widget
 *
 * @since  1.0.0
 */
function truereview_customize_tag_cloud( $args ) {
	$args['largest']  = 12;
	$args['smallest'] = 12;
	$args['unit']     = 'px';
	$args['number']   = 20;
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'truereview_customize_tag_cloud' );

/**
 * Modifies the theme layout.
 *
 * @since  1.0.0
 */
function truereview_mod_theme_layout( $layout ) {

	// Change the layout to Full Width on Attachment page.
	if ( is_attachment() && wp_attachment_is_image() ) {
		$post_layout = get_post_layout( get_queried_object_id() );
		if ( 'default' === $post_layout ) {
			$layout = '1c';
		}
	}

	// Change the layout to Full Width on teams page template.
	if ( is_page_template( 'page-templates/teams.php' ) ) {
		$post_layout = get_post_layout( get_queried_object_id() );
		if ( 'default' === $post_layout ) {
			$layout = '1c';
		}
	}

	return $layout;
}
add_filter( 'theme_mod_theme_layout', 'truereview_mod_theme_layout', 15 );

/**
 * Custom <header> attributes
 */
function truereview_attr_header( $attr ) {
	unset( $attr['id'] );
	unset( $attr['class'] );
	unset( $attr['role'] );

	return $attr;
}
add_filter( 'hybrid_attr_header',  'truereview_attr_header' );

/**
 * Custom <footer> attributes
 */
function truereview_attr_footer( $attr ) {
	unset( $attr['id'] );
	unset( $attr['class'] );
	unset( $attr['role'] );

	return $attr;
}
add_filter( 'hybrid_attr_footer', 'truereview_attr_footer' );

/**
 * Custom <main> attributes
 */
function truereview_attr_main( $attr ) {
	$attr['class'] = 'site-main';
	unset( $attr['id'] );
	unset( $attr['role'] );

	if ( isset( $attr['itemprop'] ) ) {
		$attr['itemtype']  = 'http://schema.org/WebPageElement';
		$attr['itemscope'] = 'itemscope';
	}

	return $attr;
}
add_filter( 'hybrid_attr_content', 'truereview_attr_main' );

/**
 * Custom sidebar attributes
 */
function truereview_attr_sidebar( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_sidebar', 'truereview_attr_sidebar' );

/**
 * Custom <nav> attributes
 */
function truereview_attr_menu( $attr ) {
	unset( $attr['class'] );
	unset( $attr['role'] );

	return $attr;
}
add_filter( 'hybrid_attr_menu', 'truereview_attr_menu' );

/**
 * Custom site-title
 */
function truereview_attr_site_title( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_site-title', 'truereview_attr_site_title' );

/**
 * Custom site-description
 */
function truereview_attr_site_description( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_site-description', 'truereview_attr_site_description' );

/**
 * Custom post <article> attributes
 */
function truereview_attr_post( $attr ) {
	unset( $attr['id'] );
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_post', 'truereview_attr_post' );

/**
 * Custom entry-title
 */
function truereview_attr_entry_title( $attr ) {
	unset( $attr['id'] );
	unset( $attr['class'] );
	unset( $attr['role'] );

	return $attr;
}
add_filter( 'hybrid_attr_entry-title', 'truereview_attr_entry_title' );

/**
 * Custom entry-author
 */
function truereview_attr_entry_author( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_entry-author', 'truereview_attr_entry_author' );

/**
 * Custom entry-published
 */
function truereview_attr_entry_published( $attr ) {
	unset( $attr['class'] );
	unset( $attr['content'] );

	return $attr;
}
add_filter( 'hybrid_attr_entry-published', 'truereview_attr_entry_published' );

/**
 * Custom entry-content
 */
function truereview_attr_entry_content( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_entry-content', 'truereview_attr_entry_content' );

/**
 * Custom entry-summary
 */
function truereview_attr_entry_summary( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_entry-summary', 'truereview_attr_entry_summary' );

/**
 * Custom entry-terms
 */
function truereview_attr_entry_terms( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_entry-terms', 'truereview_attr_entry_terms' );

/**
 * Comments
 */
function truereview_attr_comment( $attr ) {
	unset( $attr['id'] );
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_comment', 'truereview_attr_comment' );

/**
 * Custom comment-author
 */
function truereview_attr_comment_author( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_comment-author', 'truereview_attr_comment_author' );

/**
 * Custom comment-published
 */
function truereview_attr_comment_published( $attr ) {
	unset( $attr['datetime'] );

	return $attr;
}
add_filter( 'hybrid_attr_comment-published', 'truereview_attr_comment_published' );

/**
 * Custom comment-permalink
 */
function truereview_attr_comment_permalink( $attr ) {
	unset( $attr['href'] );

	return $attr;
}
add_filter( 'hybrid_attr_comment-permalink', 'truereview_attr_comment_permalink' );

/**
 * Custom comment-content
 */
function truereview_attr_comment_content( $attr ) {
	unset( $attr['class'] );

	return $attr;
}
add_filter( 'hybrid_attr_comment-content', 'truereview_attr_comment_content' );

/**
 * Remove role="navigation" from the_posts_pagination()
 */
function truereview_navigation_markup_template( $template ) {
	return str_replace( ' role="navigation"', '', $template );
}
add_filter( 'navigation_markup_template', 'truereview_navigation_markup_template' );
