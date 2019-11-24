<?php
/**
 * Predefined skins
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'truereview_customizer_skins' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0
 */
function truereview_customizer_skins() {

	// Predefined skins
	$skins = truereview_mod( PREFIX . 'skins' );

	// Load skin stylesheet
	wp_enqueue_style( 'truereview-skin', trailingslashit( get_template_directory_uri() ) . 'assets/css/skins/' . $skins . '.css', array(), null );

}
endif;
add_action( 'wp_enqueue_scripts', 'truereview_customizer_skins' );
