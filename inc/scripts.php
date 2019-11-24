<?php
/**
 * Enqueue scripts and styles.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads the theme styles & scripts.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @link  http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function truereview_enqueue() {

	// Load plugins stylesheet
	wp_enqueue_style( 'truereview-plugins-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/plugins.min.css' );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'truereview-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'truereview-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery', 'masonry' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'truereview-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery', 'masonry' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'truereview-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// Load custom js plugins.
		wp_enqueue_script( 'truereview-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/truereview.min.js', array( 'jquery', 'masonry' ), null, true );

	}

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'truereview-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Loads HTML5 Shiv
	wp_enqueue_script( 'truereview-html5', trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.min.js', array( 'jquery' ), null, false );
	wp_script_add_data( 'truereview-html5', 'conditional', 'lte IE 9' );

	// Contact page template required script.
	if ( is_page_template( 'page-templates/contact.php' ) ) {
		wp_enqueue_script( 'truereview-maps', 'https://maps.googleapis.com/maps/api/js', array(), null, false );
		wp_enqueue_script( 'truereview-custom-maps', trailingslashit( get_template_directory_uri() ) . 'assets/js/contact.js', array(), null, true );
	}

}
add_action( 'wp_enqueue_scripts', 'truereview_enqueue' );
