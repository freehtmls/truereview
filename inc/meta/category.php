<?php
/**
 * Custom 'category' taxonomy term meta
 */

/**
 * Register the term meta.
 *
 * @since  1.0.0
 */
function truereview_register_category_meta() {

	// Register 'color' meta
	register_meta( 'term', 'color', 'truereview_sanitize_hex' );

	// Register 'layout' meta
	register_meta( 'term', 'layout', 'esc_attr' );

	// Register 'list_layout' meta
	register_meta( 'term', 'list_layout', 'esc_attr' );

	// Register 'featured' meta
	register_meta( 'term', 'featured', 'truereview_sanitize_checkbox' );

	// Register 'featured_style' meta
	register_meta( 'term', 'featured_style', 'esc_attr' );

}
add_action( 'init', 'truereview_register_category_meta' );

/**
 * Add new form screen term color field.
 *
 * @since  1.0.0
 */
function truereview_new_term_color_field() {

	wp_nonce_field( basename( __FILE__ ), 'tj_custom_term_fields' ); ?>

	<div class="form-field tj-term-color-wrap">
		<label for="tj-term-color"><?php esc_html_e( 'Color', 'truereview' ); ?></label>
		<input type="text" name="tj_term_color" id="tj-term-color" value="#46a546" class="tj-color-field" data-default-color="#46a546" />
	</div>

	<div class="form-field tj-term-layout-wrap">
		<label for=""><?php esc_html_e( 'Layout', 'truereview' ); ?></label>
		<ul>
			<li><input type="radio" name="tj_term_layout" id="tj-term-layout-default" value="default" checked /><label for="tj-term-layout-default" class="inline"><?php esc_html_e( 'Default', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_layout" id="tj-term-layout-1c" value="1c" /><label for="tj-term-layout-1c" class="inline"><?php esc_html_e( 'Full Width', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_layout" id="tj-term-layout-1c-n" value="1c-n" /><label for="tj-term-layout-1c-n" class="inline"><?php esc_html_e( 'Full Width Narrow', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_layout" id="tj-term-layout-2c-l" value="2c-l" /><label for="tj-term-layout-2c-l" class="inline"><?php esc_html_e( 'Content / Sidebar', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_layout" id="tj-term-layout-2c-r" value="2c-r" /><label for="tj-term-layout-2c-r" class="inline"><?php esc_html_e( 'Sidebar / Content', 'truereview' ); ?></label></li>
		</ul>
	</div>

	<div class="form-field tj-term-list-layout-wrap">
		<label for=""><?php esc_html_e( 'List Layout', 'truereview' ); ?></label>
		<ul>
			<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-default" value="default" checked /><label for="tj-term-list-layout-default" class="inline"><?php esc_html_e( 'Default', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-blog" value="blog" /><label for="tj-term-list-layout-blog" class="inline"><?php esc_html_e( 'Blog Style', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-grid" value="grid" /><label for="tj-term-list-layout-grid" class="inline"><?php esc_html_e( 'Grid Style', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-masonry" value="masonry" /><label for="tj-term-list-layout-masonry" class="inline"><?php esc_html_e( 'Masonry Style', 'truereview' ); ?></label></li>
		</ul>
	</div>

	<div class="form-field tj-term-featured-wrap">
		<label for=""><?php esc_html_e( 'Featured Posts', 'truereview' ); ?></label>
		<input type="checkbox" name="tj_term_featured" id="tj-term-featured" value="1" checked /><label for="tj-term-featured" class="inline"><?php esc_html_e( 'Enable', 'truereview' ); ?></label>
	</div>

	<div class="form-field tj-term-featured-style-wrap">
		<label for=""><?php esc_html_e( 'Featured Posts Style', 'truereview' ); ?></label>
		<ul>
			<li><input type="radio" name="tj_term_featured_style" id="tj-term-featured-style-slider" value="slider" checked /><label for="tj-term-featured-style-slider" class="inline"><?php esc_html_e( 'Slider', 'truereview' ); ?></label></li>
			<li><input type="radio" name="tj_term_featured_style" id="tj-term-featured-style-grid" value="grid" /><label for="tj-term-featured-style-grid" class="inline"><?php esc_html_e( 'Grid', 'truereview' ); ?></label></li>
		</ul>
	</div>
<?php }
add_action( 'category_add_form_fields', 'truereview_new_term_color_field' );

/**
 * Edit form screen term color field.
 *
 * @since  1.0.0
 */
function truereview_edit_term_color_field( $term ) {

	// Nonce
	wp_nonce_field( basename( __FILE__ ), 'tj_custom_term_fields' );

	// Color
	$color = get_term_meta( $term->term_id, 'color', true );
	$color = $color ? truereview_get_term_color( $term->term_id, true ) : '#46a546';

	// Layout
	$layout = get_term_meta( $term->term_id, 'layout', true );
	$layout = $layout ? esc_attr( $layout ) : 'default';

	// List Layout
	$list = get_term_meta( $term->term_id, 'list_layout', true );
	$list = $list ? esc_attr( $list ) : 'default';

	// Enable featured
	$featured = get_term_meta( $term->term_id, 'featured', true );
	$featured = $featured !== '' ? $featured : 1;

	// Featured Posts Style
	$style = get_term_meta( $term->term_id, 'featured_style', true );
	$style = $style ? esc_attr( $style ) : 'slider';
	?>

	<tr class="form-field tj-term-color-wrap">
		<th scope="row"><label for="tj-term-color"><?php esc_html_e( 'Color', 'truereview' ); ?></label></th>
		<td>
			<input type="text" name="tj_term_color" id="tj-term-color" value="<?php echo esc_attr( $color ); ?>" class="tj-color-field" data-default-color="#46a546" />
		</td>
	</tr>

	<tr class="form-field tj-term-layout-wrap">
		<th scope="row"><label for="tj-term-layout"><?php esc_html_e( 'Layout', 'truereview' ); ?></label></th>
		<td>
			<ul>
				<li><input type="radio" name="tj_term_layout" id="tj-term-layout-default" value="default" <?php checked( $layout, 'default' ); ?> /><label for="tj-term-layout-default"><?php esc_html_e( 'Default', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_layout" id="tj-term-layout-1c" value="1c" <?php checked( $layout, '1c' ); ?> /><label for="tj-term-layout-1c"><?php esc_html_e( 'Full Width', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_layout" id="tj-term-layout-1c-n" value="1c-n" <?php checked( $layout, '1c-n' ); ?> /><label for="tj-term-layout-1c-n"><?php esc_html_e( 'Full Width Narrow', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_layout" id="tj-term-layout-2c-l" value="2c-l" <?php checked( $layout, '2c-l' ); ?> /><label for="tj-term-layout-2c-l"><?php esc_html_e( 'Content / Sidebar', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_layout" id="tj-term-layout-2c-r" value="2c-r" <?php checked( $layout, '2c-r' ); ?> /><label for="tj-term-layout-2c-r"><?php esc_html_e( 'Sidebar / Content', 'truereview' ); ?></label></li>
			</ul>
		</td>
	</tr>

	<tr class="form-field tj-term-list-layout-wrap">
		<th scope="row"><label for="tj-term-list-layout"><?php esc_html_e( 'List Layout', 'truereview' ); ?></label></th>
		<td>
			<ul>
				<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-default" value="default" <?php checked( $list, 'default' ); ?> /><label for="tj-term-list-layout-default"><?php esc_html_e( 'Default', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-blog" value="blog" <?php checked( $list, 'blog' ); ?> /><label for="tj-term-list-layout-blog"><?php esc_html_e( 'Blog Style', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-grid" value="grid" <?php checked( $list, 'grid' ); ?> /><label for="tj-term-list-layout-grid"><?php esc_html_e( 'Grid Style', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_list_layout" id="tj-term-list-layout-masonry" value="masonry" <?php checked( $list, 'masonry' ); ?> /><label for="tj-term-list-layout-masonry"><?php esc_html_e( 'Masonry Style', 'truereview' ); ?></label></li>
			</ul>
		</td>
	</tr>

	<tr class="form-field tj-term-featured-wrap">
		<th scope="row"><label for="tj-term-featured"><?php esc_html_e( 'Featured Posts', 'truereview' ); ?></label></th>
		<td>
			<input type="checkbox" name="tj_term_featured" id="tj-term-featured" value="1" <?php checked( $featured, 1 ); ?> /><label for="tj-term-featured" class="inline"><?php esc_html_e( 'Enable', 'truereview' ); ?></label><br />
			<p class="description"><?php printf( esc_html__( 'Please setup the Featured Posts on %1$sCustomizer%2$s.', 'truereview' ), '<a href="' . esc_url( admin_url( 'customize.php?autofocus[control]=truereview-featured-enable' ) ) . '">', '</a>' ) ?></p>
		</td>
	</tr>

	<tr class="form-field tj-term-featured-style-wrap">
		<th scope="row"><label for="tj-term-featured-style"><?php esc_html_e( 'Featured Posts Style', 'truereview' ); ?></label></th>
		<td>
			<ul>
				<li><input type="radio" name="tj_term_featured_style" id="tj-term-featured-style-slider" value="slider" <?php checked( $style, 'slider' ); ?> /><label for="tj-term-featured-style-slider"><?php esc_html_e( 'Slider', 'truereview' ); ?></label></li>
				<li><input type="radio" name="tj_term_featured_style" id="tj-term-featured-style-grid" value="grid" <?php checked( $style, 'grid' ); ?> /><label for="tj-term-featured-style-grid"><?php esc_html_e( 'Grid', 'truereview' ); ?></label></li>
			</ul>
		</td>
	</tr>
<?php }
add_action( 'category_edit_form_fields', 'truereview_edit_term_color_field' );

/**
 * Saving term
 *
 * @since  1.0.0
 * @param  int $term_id
 * @return null
 */
function truereview_save_term_color( $term_id ) {

	if ( ! isset( $_POST['tj_custom_term_fields'] ) || ! wp_verify_nonce( $_POST['tj_custom_term_fields'], basename( __FILE__ ) ) )
		return;

	$meta = array(
		'color'          => isset( $_POST['tj_term_color'] ) ? truereview_sanitize_hex( $_POST['tj_term_color'] ) : '#46a546',
		'layout'         => isset( $_POST['tj_term_layout'] ) ? esc_attr( $_POST['tj_term_layout'] ) : 'default',
		'list_layout'    => isset( $_POST['tj_term_list_layout'] ) ? esc_attr( $_POST['tj_term_list_layout'] ) : 'default',
		'featured'       => $_POST['tj_term_featured'],
		'featured_style' => isset( $_POST['tj_term_featured_style'] ) ? esc_attr( $_POST['tj_term_featured_style'] ) : 'slider',
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		$meta_value = get_post_meta( $term_id, $meta_key, true );

		if ( $meta_value && '' === $new_meta_value )
			delete_term_meta( $term_id, $meta_key, $meta_value );

		else if ( $new_meta_value !== $meta_value )
			update_term_meta( $term_id, $meta_key, $new_meta_value );

	}
}
add_action( 'edit_category',   'truereview_save_term_color' );
add_action( 'create_category', 'truereview_save_term_color' );
