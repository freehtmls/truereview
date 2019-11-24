<?php
/**
 * Helper function for the custom term meta
 */

/**
 * Wrapper function to get the term data
 *
 * @since 1.0.0
 */
function truereview_get_term_meta( $term = 'color', $default = 'default' ) {

	// Get the term data
	$term_id   = get_queried_object()->term_id;
	$term_data = get_term_meta( $term_id, $term, true );
	$term_data = $term_data ? $term_data : $default;

	return $term_data;
}

/**
 * Wrapper function that can return the color with or
 * without the preceding # mark.
 *
 * @since 1.0.0
 */
function truereview_get_term_color( $term_id, $hash = false ) {

	$color = get_term_meta( $term_id, 'color', true );
	$color = truereview_sanitize_hex( $color );

	return $hash && $color ? "#{$color}" : $color;
}

/**
 * Enqueue scripts and styles used for the term meta
 *
 * @since  1.0.0
 */
function truereview_admin_enqueue_scripts( $hook_suffix ) {

	if ( 'edit-tags.php' !== $hook_suffix || 'category' !== get_current_screen()->taxonomy )
		return;

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	add_action( 'admin_head',   'truereview_term_styles' );
	add_action( 'admin_footer', 'truereview_term_scripts' );
}
add_action( 'admin_enqueue_scripts', 'truereview_admin_enqueue_scripts' );

/**
 * Term custom styles
 *
 * @since 1.0.0
 */
function truereview_term_styles() { ?>
	<style type="text/css">
		.form-wrap label.inline { display: inline-block; }
	</style>
<?php }


/**
 * Term custom scripts
 *
 * @since  1.0.0
 */
function truereview_term_scripts() { ?>
	<script type="text/javascript">
		jQuery( document ).ready( function( $ ) {
			$( '.tj-color-field' ).wpColorPicker();
		} );
	</script>
<?php }
