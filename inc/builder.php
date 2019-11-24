<?php
/**
 * Siteorigin Panels Compatibility File
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Registers custom builder.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function truereview_builders_init() {

	// Classic block
	require trailingslashit( get_template_directory() ) . 'inc/builder/classic.php';
	register_widget( 'TrueReview_Classic_Block' );

	// Modern block
	require trailingslashit( get_template_directory() ) . 'inc/builder/modern.php';
	register_widget( 'TrueReview_Modern_Block' );

	// Modern vertical block
	require trailingslashit( get_template_directory() ) . 'inc/builder/modern-vertical.php';
	register_widget( 'TrueReview_Modern_Vertical_Block' );

	// Grid block
	require trailingslashit( get_template_directory() ) . 'inc/builder/grid.php';
	register_widget( 'TrueReview_Grid_Block' );

	// Grid classic block
	require trailingslashit( get_template_directory() ) . 'inc/builder/grid-classic.php';
	register_widget( 'TrueReview_Grid_Classic_Block' );

	// Advertisement block
	require trailingslashit( get_template_directory() ) . 'inc/builder/ads.php';
	register_widget( 'TrueReview_Ads_Block' );

}
add_action( 'widgets_init', 'truereview_builders_init' );

/**
 * Add new panel
 *
 * @since 1.0.0
 */
function truereview_panels_add_widgets_dialog_tabs( $tabs ){

	$tabs[] = array(
		'title'  => esc_html__( 'True Review Widgets', 'truereview' ),
		'filter' => array(
			'installed' => true,
			'groups'    => array( 'truereview' )
		)
	);

	return $tabs;
}
add_filter( 'siteorigin_panels_widget_dialog_tabs', 'truereview_panels_add_widgets_dialog_tabs' );

/**
 * Set the groups for all Roku Widgets
 *
 * @since 1.0.0
 */
function truereview_panels_add_widget_groups( $widgets ){
	$widgets['TrueReview_Ads_Block']['groups'] = array( 'truereview' );
	$widgets['TrueReview_Classic_Block']['groups'] = array( 'truereview' );
	$widgets['TrueReview_Modern_Block']['groups'] = array( 'truereview' );
	$widgets['TrueReview_Modern_Vertical_Block']['groups'] = array( 'truereview' );
	$widgets['TrueReview_Grid_Block']['groups'] = array( 'truereview' );
	$widgets['TrueReview_Grid_Classic_Block']['groups'] = array( 'truereview' );
	return $widgets;
}
add_filter( 'siteorigin_panels_widgets', 'truereview_panels_add_widget_groups' );

/**
 * Change the margin bottom between block.
 *
 * @since 1.0.0
 */
function truereview_panels_margin_bottom( $panels_margin_bottom ) {
	$panels_margin_bottom = '50px';
	return $panels_margin_bottom;
}
add_filter( 'siteorigin_panels_css_row_margin_bottom', 'truereview_panels_margin_bottom', 10, 4 );

/**
 * Filter the widget output
 *
 * @since 1.0.0
 */
function truereview_panels_widget_args( $args ) {
	$args['before_title'] = '<h3 class="widget-title">';
	$args['after_title']  = '</h3>';
	return $args;
}
add_filter( 'siteorigin_panels_widget_args', 'truereview_panels_widget_args' );

/**
 * Adds default page layouts
 *
 * @since 1.0.0
 */
function truereview_prebuilt_page_layouts( $layouts ) {

	$layouts['default-home'] = array (
		'name'        => esc_html__( 'Home Page', 'truereview' ),
		'description' => esc_html__( 'Prebuilt layout for home page.', 'truereview' ),
		'widgets' =>
		array(
			0 =>
			array(
				'id'    => '',
				'info'  => array(
					'class' => 'TrueReview_Modern_Block',
					'id'    => '1',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			1 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Ads_Block',
					'id'    => '2',
					'grid'  => '0',
					'cell'  => '0',
				),
			),
			2 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Modern_Vertical_Block',
					'id'    => '3',
					'grid'  => '1',
					'cell'  => '0',
				),
			),
			3 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Modern_Vertical_Block',
					'id'    => '4',
					'grid'  => '1',
					'cell'  => '1',
				),
			),
			4 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Grid_Block',
					'id'    => '5',
					'grid'  => '2',
					'cell'  => '0',
				),
			),
			5 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Ads_Block',
					'id'    => '6',
					'grid'  => '2',
					'cell'  => '0',
				),
			),
			6 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Grid_Classic_Block',
					'id'    => '7',
					'grid'  => '2',
					'cell'  => '0',
				),
			),
			7 =>
			array(
				'info'  => array(
					'class' => 'TrueReview_Classic_Block',
					'id'    => '8',
					'grid'  => '2',
					'cell'  => '0',
				),
			),
		),

		'grids' =>
		array(
			0 =>
			array(
				'cells' => '1',
				'style' => '',
			),
			1 =>
			array(
				'cells' => '2',
				'style' => '',
			),
			2 =>
			array(
				'cells' => '1',
				'style' => '',
			),
		),

		'grid_cells' =>
		array(
			0 =>
			array(
				'weight' => '1',
				'grid'   => '0',
			),
			1 =>
			array(
				'weight' => '0.5',
				'grid'   => '1',
			),
			2 =>
			array(
				'weight' => '0.5',
				'grid'   => '1',
			),
			3 =>
			array(
				'weight' => '1',
				'grid'   => '2',
			),
		),
	);

	return $layouts;

}
add_filter( 'siteorigin_panels_prebuilt_layouts', 'truereview_prebuilt_page_layouts' );
