<?php
/**
 * Fonts
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'truereview_customizer_fonts' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function truereview_customizer_fonts() {

	// Text font
	$text  = truereview_mod( PREFIX . 'text-font' );
	$stack = customizer_library_get_font_stack( $text );

	if ( $text !== customizer_library_get_default( PREFIX . 'text-font' ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'body'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );
	}

	// Heading font
	$heading = truereview_mod( PREFIX . 'heading-font' );
	$stack   = customizer_library_get_font_stack( $heading );

	if ( $heading !== customizer_library_get_default( PREFIX . 'heading-font' ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );
	}

}
endif;
add_action( 'truereview_customizer_library_styles', 'truereview_customizer_fonts' );

if ( ! function_exists( 'truereview_enqueue_fonts' ) ) :
/**
 * Enqueue Google Fonts
 *
 * @since  1.0.0
 */
function truereview_enqueue_fonts() {

	// Font options
	$fonts = array(
		truereview_mod( PREFIX . 'text-font' ),
		truereview_mod( PREFIX . 'heading-font' )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'truereview-custom-fonts', $font_uri, array(), null );

}
endif;
add_action( 'wp_enqueue_scripts', 'truereview_enqueue_fonts' );
