<?php
/**
 * Customizer Utility Functions
 *
 * @package 	Customizer_Library
 * @author		Devin Price, The Theme Foundry, Theme Junkie
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customizer_library_customize_preview_js() {
	$path = get_template_directory_uri() . '/admin';
	wp_enqueue_script( 'customizer-library-customizer', trailingslashit( $path ) . 'js/preview.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'customizer_library_customize_preview_js' );

/**
 * Enqueue customizer sections script
 */
function truereview_customizer_scripts() {
	$path = get_template_directory_uri() . '/admin';
	wp_enqueue_style( 'customizer-library-css', trailingslashit( $path ) . 'css/customizer.css', array(), '1.0.0' );

}
add_action( 'customize_controls_enqueue_scripts', 'truereview_customizer_scripts' );
