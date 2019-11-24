<?php
/**
 * Custom coupon
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Display the coupon
 *
 * @since  1.0.0
 */
function truereview_coupon( $content ) {

	// Set up empty variable
	$coupon = '';

	// Get the metaboxes data
	$enable  = get_post_meta( get_the_ID(), 'tj_coupon_enable', true );
	$pos     = get_post_meta( get_the_ID(), 'tj_coupon_position', true );
	$code    = get_post_meta( get_the_ID(), 'tj_coupon_code', true );
	$url     = get_post_meta( get_the_ID(), 'tj_coupon_destination_url', true );
	$btntxt  = get_post_meta( get_the_ID(), 'tj_coupon_button_text', true );

	// Coupon markup
	$coupon = '<div class="coupon-wrapper">';
		$coupon .= '<span class="coupon-title">' . esc_html__( 'Coupon Code', 'truereview' ) . '</span>';
		$coupon .= '<form action="' . esc_url( $url ) . '" method="post" target="_blank">';
			$coupon .= '<button data-clipboard-text="' . esc_attr( $code ) . '" class="coupon-code" type="submit"><i class="fa fa-scissors"></i> ' . esc_attr( $code ) . '</button>';
		$coupon .= '</form>';
		$coupon .= '<span class="click">' . esc_html__( '(Click to Copy & Open Site)', 'truereview' ) . '</span>';
	$coupon .= '</div>';

	// Display the coupon area
	if ( $pos === 'bottom' ) {
		if ( is_single() && !empty( $code ) && $enable ) {
			$content = $content . $coupon;
		} else {
			$content;
		}
	} else {
		if ( is_single() && !empty( $code ) && $enable ) {
			$content = $coupon . $content;
		} else {
			$content;
		}
	}

	return $content;

}
add_filter( 'the_content', 'truereview_coupon', 20 );
