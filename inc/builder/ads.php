<?php
/**
 * Advertisement block.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Ads_Block extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'truereview_ads_block',
			'description' => esc_html__( 'Easily to display any type of ads.', 'truereview' )
		);

		// Create the widget.
		parent::__construct(
			'truereview_ads_block',                            // $this->id_base
			esc_html__( 'Advertisement Block', 'truereview' ), // $this->name
			$widget_options                                   // $this->widget_options
		);

		$this->alt_option_name = 'truereview_ads_block';
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		// Set up default value
		$ad_code = ( ! empty( $instance['ad_code'] ) ) ? $instance['ad_code'] : '';

		// Output the theme's $before_widget wrapper.
		echo $args['before_widget'];

		// Display the ad banner.
		if ( $ad_code ) {
			echo '<div class="ads-block">' . stripslashes( $ad_code ) . '</div>';
		}

		// Close the theme's widget wrapper.
		echo $args['after_widget'];

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['ad_code'] = stripslashes( $new_instance['ad_code'] );
		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		$ad_code = isset( $instance['ad_code'] ) ? stripslashes( $instance['ad_code'] ) : '';
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad_code' ); ?>">
				<?php esc_html_e( 'Ad Code', 'truereview' ); ?>
			</label>
			<textarea class="widefat" name="<?php echo $this->get_field_name( 'ad_code' ); ?>" id="<?php echo $this->get_field_id( 'ad_code' ); ?>" cols="30" rows="6"><?php echo stripslashes( $ad_code ); ?></textarea>
		</p>

	<?php

	}

}
