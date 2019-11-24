<?php
/**
 * Custom function to display data set in customizer.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Loads custom style set in customizer
 */
require trailingslashit( get_template_directory() ) . 'inc/styles/fonts.php';
require trailingslashit( get_template_directory() ) . 'inc/styles/skins.php';

if ( ! function_exists( 'truereview_customizer_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0
 */
function truereview_customizer_styles() {

	// Action to add the custom styles.
	do_action( 'truereview_customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}

}
endif;
add_action( 'wp_head', 'truereview_customizer_styles', 11 );

if ( ! function_exists( 'truereview_custom_feed_url' ) ) :
/**
 * Custom RSS feed url.
 *
 * @since  1.0.0
 */
function truereview_custom_feed_url( $output, $feed ) {

	// Get the custom rss feed url
	$url = truereview_mod( PREFIX . 'custom-rss' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( ! empty( $url ) ) {
		$output = esc_url( $url );
	}

	return $output;
}
endif;
add_filter( 'feed_link', 'truereview_custom_feed_url', 10, 2 );

if ( ! function_exists( 'truereview_top_ads' ) ) :
/**
 * Prints the advertisement data set in customizer.
 *
 * @since  1.0.0
 */
function truereview_top_ads() {

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'top-ads-image' );
	$url    = truereview_mod( PREFIX . 'top-ads-url' );
	$custom = truereview_mod( PREFIX . 'top-ads-custom' );

	// Display the data
	if ( $img || $url || $custom ) {
		echo '<div class="top-ads">';
			echo '<div class="container">';
				if ( $custom ) {
					echo stripslashes( $custom );
				} else {
					echo '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
				}
			echo '</div>';
		echo '</div>';
	}

}
endif;

if ( ! function_exists( 'truereview_header_ads' ) ) :
/**
 * Prints the advertisement data set in customizer.
 *
 * @since  1.0.0
 */
function truereview_header_ads() {

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'header-ads-image' );
	$url    = truereview_mod( PREFIX . 'header-ads-url' );
	$custom = truereview_mod( PREFIX . 'header-ads-custom' );

	// Display the data
	if ( $img || $url || $custom ) {
		echo '<div class="header-ad">';
			if ( $custom ) {
				echo stripslashes( $custom );
			} else {
				echo '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
			}
		echo '</div>';
	}

}
endif;

if ( ! function_exists( 'truereview_after_menu_ads' ) ) :
/**
 * Prints the advertisement data set in customizer.
 *
 * @since  1.0.0
 */
function truereview_after_menu_ads() {

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'after-menu-ads-image' );
	$url    = truereview_mod( PREFIX . 'after-menu-ads-url' );
	$custom = truereview_mod( PREFIX . 'after-menu-ads-custom' );

	// Display the data
	if ( $img || $url || $custom ) {
		echo '<div class="after-menu-ads">';
			echo '<div class="container">';
				if ( $custom ) {
					echo stripslashes( $custom );
				} else {
					echo '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
				}
			echo '</div>';
		echo '</div>';
	}

}
endif;

if ( ! function_exists( 'truereview_post_ads_before' ) ) :
/**
 * Single post advertisement.
 * Before content.
 *
 * @since  1.0.0
 */
function truereview_post_ads_before( $content ) {

	// Set up empty variable
	$ads = '';

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'post-ads-image-before' );
	$url    = truereview_mod( PREFIX . 'post-ads-url-before' );
	$custom = truereview_mod( PREFIX . 'post-ads-custom-before' );
	$pos    = truereview_mod( PREFIX . 'post-ads-position-before' );

	// Set up our ads.
	if ( $img || $url || $custom ) {
		$ads = '<div class="post-ads-before post-ads ' . esc_attr( $pos ) . '-position' . '">';
			if ( $custom ) {
				$ads .= stripslashes( $custom );
			} else {
				$ads .= '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
			}
		$ads .= '</div>';
	}

	// Display the ads before content
	if ( ! empty( $ads ) && is_single() ) {
		$content = $ads . $content;
	} else {
		$content;
	}

	return $content;

}
endif;
add_filter( 'the_content', 'truereview_post_ads_before', 20 );

if ( ! function_exists( 'truereview_post_ads_after' ) ) :
/**
 * Single post advertisement.
 * After content.
 *
 * @since  1.0.0
 */
function truereview_post_ads_after( $content ) {

	// Set up empty variable
	$ads = '';

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'post-ads-image-after' );
	$url    = truereview_mod( PREFIX . 'post-ads-url-after' );
	$custom = truereview_mod( PREFIX . 'post-ads-custom-after' );
	$pos    = truereview_mod( PREFIX . 'post-ads-position-after' );

	// Set up our ads.
	if ( $img || $url || $custom ) {
		$ads = '<div class="post-ads-after post-ads ' . esc_attr( $pos ) . '-position' . '">';
			if ( $custom ) {
				$ads .= stripslashes( $custom );
			} else {
				$ads .= '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
			}
		$ads .= '</div>';
	}

	// Display the ads before content
	if ( ! empty( $ads ) && is_single() ) {
		$content = $content . $ads;
	} else {
		$content;
	}

	return $content;

}
endif;
add_filter( 'the_content', 'truereview_post_ads_after', 20 );

if ( ! function_exists( 'truereview_post_ads_after_paragraph' ) ) :
/**
 * Single post advertisement.
 * After x paragraph.
 *
 * @since  1.0.0
 */
function truereview_post_ads_after_paragraph( $content ) {

	// Set up empty variable
	$ads = '';

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'post-ads-image-after-paragraph' );
	$url    = truereview_mod( PREFIX . 'post-ads-url-after-paragraph' );
	$custom = truereview_mod( PREFIX . 'post-ads-custom-after-paragraph' );
	$pos    = truereview_mod( PREFIX . 'post-ads-position-after-paragraph' );
	$par    = truereview_mod( PREFIX . 'post-ads-paragraph-after-paragraph' );

	// Set up our ads.
	if ( $img || $url || $custom ) {
		$ads = '<div class="post-ads-after-paragraph post-ads ' . esc_attr( $pos ) . '-position' . '">';
			if ( $custom ) {
				$ads .= stripslashes( $custom );
			} else {
				$ads .= '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
			}
		$ads .= '</div>';
	}

	// Display the ads after x pargraph
	if ( ! empty( $ads ) && is_single() ) {
		return truereview_insert_after_paragraph( $ads, absint( $par ), $content );
	}

	return $content;

}
endif;
add_filter( 'the_content', 'truereview_post_ads_after_paragraph', 20 );

/**
 * Insert after paragraph function
 *
 * @since  1.0.0
 */
function truereview_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
	$closing_p = '</p>';
	$paragraphs = explode( $closing_p, $content );
	foreach ($paragraphs as $index => $paragraph) {

		if ( trim( $paragraph ) ) {
			$paragraphs[$index] .= $closing_p;
		}

		if ( $paragraph_id == $index + 1 ) {
			$paragraphs[$index] .= $insertion;
		}
	}

	return implode( '', $paragraphs );
}

if ( ! function_exists( 'truereview_footer_ads' ) ) :
/**
 * Prints the advertisement data set in customizer.
 *
 * @since  1.0.0
 */
function truereview_footer_ads() {

	// Get the ads data set in customizer
	$img    = truereview_mod( PREFIX . 'footer-ads-image' );
	$url    = truereview_mod( PREFIX . 'footer-ads-url' );
	$custom = truereview_mod( PREFIX . 'footer-ads-custom' );

	// Display the data
	if ( $img || $url || $custom ) {
		echo '<div class="footer-ads">';
			echo '<div class="container">';
				if ( $custom ) {
					echo stripslashes( $custom );
				} else {
					echo '<a href="' . esc_url( $url ) . '"><img src="' . esc_url( wp_get_attachment_url( $img ) ) . '" alt="' . esc_html__( 'Advertisement', 'truereview' ) . '" /></a>';
				}
			echo '</div>';
		echo '</div>';
	}

}
endif;
