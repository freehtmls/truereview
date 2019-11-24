<?php
/**
 * Custom term meta sanitization
 */

/**
 * Sanitize hex color
 *
 * @since  1.0.0
 * @param  [string] $color
 * @return [string]
 */
function truereview_sanitize_hex( $color ) {
	$color = ltrim( $color, '#' );
	return preg_match( '/([A-Fa-f0-9]{3}){1,2}$/', $color ) ? $color : '';
}

/**
 * Sanitize a checkbox to only allow 0 or 1
 *
 * @since  1.0.0.
 *
 * @param  boolean    $value    The unsanitized value.
 * @return boolean				The sanitized boolean.
 */
function truereview_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
    } else {
		return 0;
    }
}
